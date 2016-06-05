<?php

namespace App\Uploader;

use App\Models\BaseModel;

use Request;

class ImageUploader
{
	protected $uploadDir = "";
	/**
	 * 初始化
	 */
	public function __construct()
	{
		$this->uploadDir = public_path(BaseModel::IMAGE_BASE_PATH);
	}
    
    /**
     * 上传图片
     */
	public function upload()
	{
		if(!Request::hasFile('file') || !Request::file('file')->isValid() ) {
			die('上传图片失败');
		}

		$file = Request::file('file');
		$type = Request::input('type');

	    $dir  = $this->makeDir($this->uploadDir, 0777);

	    if(!$dir_handle = opendir($dir)) {
	    	die('上传图片指定目录无法打开');
	    }

	    list($maintype, $subtype) = explode('/', $type);

	    // 图片名
	    $filename = $this->getFileName($subtype);

		Request::file('file')->move($dir, $filename);

		return json_encode(['remark' => '图片上传成功', 'imagename' => strrchr($dir, BaseModel::IMAGE_BASE_PATH).'/'.$filename]);
	}
    
    /**
     * 图片预览
     */
	public function preview()
	{
        /**
         * 此页面用来协助 IE6/7 预览图片，因为 IE 6/7 不支持 base64
         */

        $DIR = 'preview';
        // Create target dir
        if (!file_exists($DIR)) {
        @mkdir($DIR);
        }

        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        if ($cleanupTargetDir) {
        if (!is_dir($DIR) || !$dir = opendir($DIR)) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
        }

        while (($file = readdir($dir)) !== false) {
            $tmpfilePath = $DIR . DIRECTORY_SEPARATOR . $file;

            // Remove temp file if it is older than the max age and is not the current file
            if (@filemtime($tmpfilePath) < time() - $maxFileAge) {
                @unlink($tmpfilePath);
            }
        }
        closedir($dir);
        }

        $src = file_get_contents('php://input');

        if (preg_match("#^data:image/(\w+);base64,(.*)$#", $src, $matches)) {

        $previewUrl = sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['HTTP_HOST'],
            $_SERVER['REQUEST_URI']
        );
        $previewUrl = str_replace("preview.php", "", $previewUrl);


        $base64 = $matches[2];
        $type = $matches[1];
        if ($type === 'jpeg') {
            $type = 'jpg';
        }

        $filename = md5($base64).".$type";
        $filePath = $DIR.DIRECTORY_SEPARATOR.$filename;

        if (file_exists($filePath)) {
            die('{"jsonrpc" : "2.0", "result" : "'.$previewUrl.'preview/'.$filename.'", "id" : "id"}');
        } else {
            $data = base64_decode($base64);
            file_put_contents($filePath, $data);
            die('{"jsonrpc" : "2.0", "result" : "'.$previewUrl.'preview/'.$filename.'", "id" : "id"}');
        }

        } else {
            die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "un recoginized source"}}');
        }
	}
    
    /**
     * 生成图片名
     */
	public function getFileName($type)
	{
		return date('Ymd').mt_rand(0,100).uniqid().'.'.$type;
	}
    
    /**
     * 生成图片保存路径
     */
	public function makeDir($target_dir, $mode)
	{
		if(!file_exists($target_dir)) {
			@mkdir($target_dir, $mode, true);
		}

		$dir     = trim($target_dir, '/').'/';
		$year    = $dir.date('Y');
		$month   = $year.'/'.date('m');
		$day     = $month.'/'.date('d');

		if(!file_exists($year)) {
			@mkdir($year, $mode, true);
		}

		if(!file_exists($month)) {
			@mkdir($month, $mode, true);
		}

		if(!file_exists($day)) {
			@mkdir($day, $mode, true);
		}

		return $day;
	}
}
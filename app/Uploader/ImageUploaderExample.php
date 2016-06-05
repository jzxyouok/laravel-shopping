<?php

namespace App\Uploader;

class ImageUploader {
    // private $targetDir = "{!! asset('images/upload/images_tmp/') !!}";
    // private $uploadDir = "{!! asset('images/upload/images/') !!}";
    // private $allowtype = array('jpg', 'jpeg', 'gif', 'png');
    // private $maxsize = 1048576;
    // private $name = "";
    // public $targetDir = 'D:\wamp\www\planb\public\images\upload\images_tmp';
    // public $uploadDir = 'D:\wamp\www\planb\public\images\upload\images';
    public $targetDir = ''; //public_path() . '/images/upload/images_tmp';
    public $uploadDir = ''; //public_path() . '/images/upload/images';

    public function __construct() {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        $this->targetDir = public_path() . '/images/upload_tmp/';    
        $this->uploadDir = public_path() . '/images/upload/';
    } 

    // public function set($option = array()) {
    //  if(!empty($option)) {
    //      $varArr = get_class_vars(get_class($this));
    //      foreach($option as $key=>$val) {
    //          if(!array_key_exists($key, $value)) continue;
    //          $this->$key = $val;
    //      }
    //  }
    // }

    // public function checkFIleSize($fileSize) {
    //  if($fileSize > $this->maxsize) return false;
    //  return true;
    // }

    // public function checkFileType($fileType) {
    //  if(in_array(strtolower($fileType), $this->allowtype)) return true;
    //  return false;
    // }

    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit; // finish preflight CORS requests here
        }


        if ( !empty($_REQUEST[ 'debug' ]) ) {
            $random = rand(0, intval($_REQUEST[ 'debug' ]) );
            if ( $random === 0 ) {
                header("HTTP/1.0 500 Internal Server Error");
                exit;
            }
        }

        @set_time_limit(5 * 60);

        $targetDir = $this->targetDir;
        $uploadDir = $this->uploadDir;

        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        // Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

        // Create target dir
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir);
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }

        // echo '<pre>';
        // var_dump( $_REQUEST);
        // exit;

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        // $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
        $suffix = strrchr($fileName, '.');
        $fileName2 = date('Ymd').uniqid().mt_rand(0,100).$suffix;
        $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName2;
        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;
// dd($targetDir);

        // Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


        // Open temp file
        if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

        $index = 0;
        $done = true;
        for( $index = 0; $index < $chunks; $index++ ) {
            if ( !file_exists("{$filePath}_{$index}.part") ) {
                $done = false;
                break;
            }
        }
        if ( $done ) {
            if (!$out = @fopen($uploadPath, "wb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }

            if ( flock($out, LOCK_EX) ) {
                for( $index = 0; $index < $chunks; $index++ ) {
                    if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                        break;
                    }

                    while ($buff = fread($in, 4096)) {
                        fwrite($out, $buff);
                    }

                    @fclose($in);
                    @unlink("{$filePath}_{$index}.part");
                }

                flock($out, LOCK_UN);
            }
            @fclose($out);
        }

        // Return Success JSON-RPC response
        // die('{"jsonrpc" : "2.0", "result" : "success", "id" : "id", "imageName" : "'.$fileName2.'"}');
        die('{"jsonrpc" : "2.0", "result" : "success", "id" : "id", "imageName" : "'.$fileName2.'"}');
    }

    public function preview() {
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
}

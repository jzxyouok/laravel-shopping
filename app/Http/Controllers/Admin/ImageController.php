<?php

namespace App\Http\Controllers\Admin;

use App\Uploader\ImageUploader;

class ImageController extends BaseController
{
    /**
     * 图片上传
     */
    public function upload(ImageUploader $upload)
    {
    	return $upload->upload();
    }

    /**
     * 图片预览
     */
    public function preview(ImageUploader $upload)
    {
    	return $upload->preview();
    }
}

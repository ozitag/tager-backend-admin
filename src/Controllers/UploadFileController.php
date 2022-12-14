<?php

namespace OZiTAG\Tager\Backend\Admin\Controllers;

use OZiTAG\Tager\Backend\Core\Controllers\Controller;
use OZiTAG\Tager\Backend\Core\Features\UploadFileFeature;

class UploadFileController extends Controller
{
    public function upload()
    {
        return $this->serve(UploadFileFeature::class, [
            'supportUrl' => true,
            'supportFile' => true
        ]);
    }
}

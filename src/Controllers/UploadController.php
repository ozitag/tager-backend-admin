<?php

namespace OZiTAG\Tager\Backend\Admin\Controllers;

use Ozerich\FileStorage\Models\File;
use Ozerich\FileStorage\Storage;
use OZiTAG\Tager\Backend\Core\Controllers\Controller;

class UploadController extends Controller
{
    public function index(Storage $storage)
    {
        /** @var File $file */
        $file = $storage->createFromRequest();

        if (!$file) {
            abort(400, $storage->getUploadError());
        }

        return $file->getShortJson();
    }
}

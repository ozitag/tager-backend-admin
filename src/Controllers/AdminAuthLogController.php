<?php

namespace OZiTAG\Tager\Backend\Admin\Controllers;

use OZiTAG\Tager\Backend\Admin\Features\AdminAuthLogsFeature;
use OZiTAG\Tager\Backend\Core\Controllers\Controller;

class AdminAuthLogController extends Controller
{
    public function index()
    {
        return $this->serve(AdminAuthLogsFeature::class);
    }
}

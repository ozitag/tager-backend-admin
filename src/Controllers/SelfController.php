<?php

namespace OZiTAG\Tager\Backend\Admin\Controllers;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Core\Controller;
use OZiTAG\Tager\Backend\Core\SuccessResource;
use OZiTAG\Tager\Backend\Admin\Resources\ProfileResource;

class SelfController extends Controller
{
    public function index()
    {
        return new ProfileResource(Auth::user());
    }

    public function logout()
    {
        Auth::user()->token()->revoke();
        return new SuccessResource();
    }
}

<?php

namespace OZiTAG\Tager\Backend\Admin\Features;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;

class LogoutFeature extends Feature
{
    public function handle()
    {
        Auth::user()->token()->revoke();
        return new SuccessResource();
    }
}

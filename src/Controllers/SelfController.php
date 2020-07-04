<?php

namespace OZiTAG\Tager\Backend\Admin\Controllers;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Admin\Features\ChangePasswordFeature;
use OZiTAG\Tager\Backend\Admin\Features\GetProfileFeature;
use OZiTAG\Tager\Backend\Admin\Features\LogoutFeature;
use OZiTAG\Tager\Backend\Admin\Features\UpdateProfileFeature;
use OZiTAG\Tager\Backend\Core\Controller;
use OZiTAG\Tager\Backend\Core\SuccessResource;
use OZiTAG\Tager\Backend\Admin\Resources\ProfileResource;

class SelfController extends Controller
{
    public function getProfile()
    {
        return $this->serve(GetProfileFeature::class);
    }

    public function updateProfile()
    {
        return $this->serve(UpdateProfileFeature::class);
    }

    public function changePassword()
    {
        return $this->serve(ChangePasswordFeature::class);
    }

    public function logout()
    {
        return $this->serve(LogoutFeature::class);
    }
}

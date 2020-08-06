<?php

namespace OZiTAG\Tager\Backend\Admin\Controllers;

use OZiTAG\Tager\Backend\Core\Controllers\Controller;
use OZiTAG\Tager\Backend\Admin\Features\Self\ChangePasswordFeature;
use OZiTAG\Tager\Backend\Admin\Features\Self\GetProfileFeature;
use OZiTAG\Tager\Backend\Admin\Features\Self\LogoutFeature;
use OZiTAG\Tager\Backend\Admin\Features\Self\UpdateProfileFeature;

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

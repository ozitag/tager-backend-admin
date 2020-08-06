<?php

namespace OZiTAG\Tager\Backend\Admin\Controllers;

use Illuminate\Session\Store;
use OZiTAG\Tager\Backend\Admin\Features\Admins\DeleteAdminFeature;
use OZiTAG\Tager\Backend\Admin\Features\Admins\ListAdminFeature;
use OZiTAG\Tager\Backend\Admin\Features\Admins\StoreAdminFeature;
use OZiTAG\Tager\Backend\Admin\Features\Admins\UpdateAdminFeature;
use OZiTAG\Tager\Backend\Admin\Features\Admins\ViewAdminFeature;
use OZiTAG\Tager\Backend\Core\Controllers\Controller;
use OZiTAG\Tager\Backend\Admin\Features\ChangePasswordFeature;
use OZiTAG\Tager\Backend\Admin\Features\GetProfileFeature;
use OZiTAG\Tager\Backend\Admin\Features\LogoutFeature;
use OZiTAG\Tager\Backend\Admin\Features\UpdateProfileFeature;

class AdminsController extends Controller
{
    public function index()
    {
        return $this->serve(ListAdminFeature::class);
    }

    public function store()
    {
        return $this->serve(StoreAdminFeature::class);
    }

    public function update($id)
    {
        return $this->serve(UpdateAdminFeature::class, [
            'id' => $id
        ]);
    }

    public function view($id)
    {
        return $this->serve(ViewAdminFeature::class, [
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        return $this->serve(DeleteAdminFeature::class, [
            'id' => $id
        ]);
    }
}

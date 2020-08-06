<?php

namespace OZiTAG\Tager\Backend\Admin\Features\Admins;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Admin\Models\Administrator;
use OZiTAG\Tager\Backend\Admin\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Admin\Resources\Admin\AdminResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;

class ListAdminFeature extends Feature
{
    public function handle(AdministratorRepository $repository)
    {
        return AdminResource::collection(Administrator::all());
    }
}

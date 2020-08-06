<?php

namespace OZiTAG\Tager\Backend\Admin\Features\Admins;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Admin\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Admin\Resources\Admin\AdminResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;

class ViewAdminFeature extends Feature
{
    protected int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function handle(AdministratorRepository $repository)
    {
        $admin = $repository->find($this->id);

        if(!$admin) {
            throw new \HttpException('Admin Not Found', 404);
        }

        return new AdminResource($admin);
    }
}

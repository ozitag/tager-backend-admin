<?php

namespace OZiTAG\Tager\Backend\Admin\Features\Admins;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Admin\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Admin\Requests\Admin\StoreAdminRequest;
use OZiTAG\Tager\Backend\Admin\Resources\Admin\AdminResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;

class StoreAdminFeature extends Feature
{
    public function handle(StoreAdminRequest $request, AdministratorRepository $repository)
    {
        $admin = $repository->fillAndSave(
            array_merge($request->only(['name', 'email']), [
                'password' => Hash::make($request->get('password'))
            ])
        );


        if(!$admin) {
            return response('', 400);
        }

        return new AdminResource($admin);
    }
}
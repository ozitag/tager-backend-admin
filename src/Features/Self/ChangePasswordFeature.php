<?php

namespace OZiTAG\Tager\Backend\Admin\Features\Self;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Admin\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\Admin\Requests\ChangePasswordRequest;

class ChangePasswordFeature extends Feature
{
    public function handle(ChangePasswordRequest $request, AdministratorRepository $repository)
    {
        $repository->setById($this->user()->id);

        $repository->fillAndSave([
            'password' => Hash::make($request->newPassword)
        ]);

        return new SuccessResource();
    }
}

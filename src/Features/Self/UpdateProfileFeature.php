<?php

namespace OZiTAG\Tager\Backend\Admin\Features\Self;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Admin\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Admin\Requests\UpdateProfileRequest;
use OZiTAG\Tager\Backend\Admin\Resources\ProfileResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;

class UpdateProfileFeature extends Feature
{
    public function handle(UpdateProfileRequest $request, AdministratorRepository $repository)
    {
        $repository->setById($this->user()->id);

        $user = $repository->fillAndSave([
            'email' => $request->get('email'),
            'name' => $request->get('name'),
        ]);

        return new ProfileResource($user);
    }
}

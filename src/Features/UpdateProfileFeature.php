<?php

namespace OZiTAG\Tager\Backend\Admin\Features;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Admin\Requests\UpdateProfileRequest;
use OZiTAG\Tager\Backend\Admin\Resources\ProfileResource;
use OZiTAG\Tager\Backend\Core\Feature;

class UpdateProfileFeature extends Feature
{
    public function handle(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        return new ProfileResource($user);
    }
}

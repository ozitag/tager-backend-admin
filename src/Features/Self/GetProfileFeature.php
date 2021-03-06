<?php

namespace OZiTAG\Tager\Backend\Admin\Features\Self;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Admin\Resources\ProfileResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;

class GetProfileFeature extends Feature
{
    public function handle()
    {
        return new ProfileResource($this->user());
    }
}

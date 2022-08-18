<?php

namespace OZiTAG\Tager\Backend\Admin\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Admin\Models\AdministratorRole;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles->map(function (AdministratorRole $role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'scopes' => $role->scopes ? explode(',', $role->scopes) : []
                ];
            })
        ];
    }
}

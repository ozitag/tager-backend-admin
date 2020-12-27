<?php

namespace OZiTAG\Tager\Backend\Admin\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminAuthLogResource extends JsonResource
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
            'ip' => $this->ip,
            'email' => $this->email,
            'administratorId' => $this->administrator_id,
            'userAgent' => $this->user_agent,
            'authSuccess' => (boolean) $this->auth_success,
        ];
    }
}

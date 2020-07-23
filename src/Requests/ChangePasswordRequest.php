<?php

namespace OZiTAG\Tager\Backend\Admin\Requests;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string'
        ];
    }
}

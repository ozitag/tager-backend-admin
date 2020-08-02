<?php

namespace OZiTAG\Tager\Backend\Admin\Requests;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;
use OZiTAG\Tager\Backend\Admin\Validation\Rules\OldPassword;

class ChangePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'oldPassword' => ['required', 'string', new OldPassword()],
            'newPassword' => 'required|string'
        ];
    }
}

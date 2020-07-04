<?php

namespace OZiTAG\Tager\Backend\Admin\Requests;

use OZiTAG\Tager\Backend\Core\FormRequest;
use Ozerich\FileStorage\Rules\FileRule;

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

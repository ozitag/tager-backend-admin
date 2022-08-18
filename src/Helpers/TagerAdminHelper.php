<?php

namespace OZiTAG\Tager\Backend\Admin\Helpers;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Admin\Models\Administrator;
use OZiTAG\Tager\Backend\Admin\Models\AdministratorField;
use OZiTAG\Tager\Backend\Admin\Utils\TagerAdminConfig;
use OZiTAG\Tager\Backend\Auth\Operations\AuthUserOperation;

class TagerAdminHelper
{
    public function paramValue(string $param, bool $returnRawValue = false)
    {
        $field = TagerAdminConfig::getField($param);
        if (!$field) {
            return null;
        }

        /** @var Administrator $user */
        $user = Auth::user();

        /** @var AdministratorField $paramModel */
        $fieldModel = $user->fields()->where('field', $param)->first();
        if (!$fieldModel) {
            return null;
        }

        if ($returnRawValue) {
            return $fieldModel->value;
        }

        $type = $field->getTypeInstance();
        $type->loadValueFromDatabase($fieldModel->value);

        return $type->getValue();
    }
}

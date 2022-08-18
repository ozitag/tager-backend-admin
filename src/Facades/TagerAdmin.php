<?php

namespace OZiTAG\Tager\Backend\Admin\Facades;

use Illuminate\Support\Facades\Facade;
use OZiTAG\Tager\Backend\Admin\Helpers\TagerAdminHelper;

/**
 * Class TagerAuth
 * @package OZiTAG\Tager\Backend\Core\Auth
 *
 * @method static paramValue(string $name, bool $returnRawValue = false)
 */
class TagerAdmin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TagerAdminHelper::class;
    }
}

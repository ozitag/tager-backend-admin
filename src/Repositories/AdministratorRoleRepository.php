<?php

namespace OZiTAG\Tager\Backend\Admin\Repositories;

use OZiTAG\Tager\Backend\Admin\Models\AdministratorRole;
use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;

class AdministratorRoleRepository extends EloquentRepository
{
    public function __construct(AdministratorRole $model)
    {
        parent::__construct($model);
    }
}

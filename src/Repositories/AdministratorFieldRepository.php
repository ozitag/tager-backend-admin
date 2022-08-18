<?php

namespace OZiTAG\Tager\Backend\Admin\Repositories;

use OZiTAG\Tager\Backend\Admin\Models\AdministratorField;
use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;

class AdministratorFieldRepository extends EloquentRepository
{
    public function __construct(AdministratorField $model)
    {
        parent::__construct($model);
    }
}

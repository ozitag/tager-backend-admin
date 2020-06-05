<?php

namespace OZiTAG\Tager\Backend\Admin\Repositories;

use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Admin\Models\AdminAuthLog;

class AdminAuthLogRepository extends EloquentRepository
{
    public function __construct(AdminAuthLog $model)
    {
        parent::__construct($model);
    }
}

<?php

namespace OZiTAG\Tager\Backend\Admin\Repositories;

use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Admin\Models\Administrator;

class AdministratorRepository extends EloquentRepository
{
    public function __construct(Administrator $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $email
     * @return Administrator|null
     */
    public function findByEmail(string $email): ?Administrator {
        return $this->model->whereEmail($email)->first();
    }
}

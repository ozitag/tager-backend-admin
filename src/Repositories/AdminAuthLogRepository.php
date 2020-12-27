<?php

namespace OZiTAG\Tager\Backend\Admin\Repositories;

use Illuminate\Database\Eloquent\Builder;
use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Admin\Models\AdminAuthLog;
use OZiTAG\Tager\Backend\Core\Repositories\ISearchable;

class AdminAuthLogRepository extends EloquentRepository implements ISearchable
{
    public function __construct(AdminAuthLog $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $uuid
     * @return AdminAuthLog|null
     */
    public function findByUuid(string $uuid): ?AdminAuthLog {
        return $this->model->whereUuid($uuid)->first();
    }

    /**
     * @param string|null $query
     * @param Builder|null $builder
     * @return Builder|null
     */
    public function searchByQuery(?string $query, Builder $builder = null): ?Builder {
        $builder = $builder ? $builder : $this->model;
        return $builder->where(function ($builder) use ($query) {
            $builder->where('email', 'LIKE', "%$query%")
                ->orWhere('administrator_id', '=', $query)
                ->orWhere('user_agent', 'LIKE', "%$query%")
                ->orWhere('ip', 'LIKE', "$query%");
        })->orderByDesc('id');
    }
}

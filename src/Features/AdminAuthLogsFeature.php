<?php

namespace OZiTAG\Tager\Backend\Admin\Features;

use Illuminate\Support\Facades\Request;
use OZiTAG\Tager\Backend\Admin\Repositories\AdminAuthLogRepository;
use OZiTAG\Tager\Backend\Admin\Resources\AdminAuthLogResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\ResourceCollection;

class AdminAuthLogsFeature extends Feature
{
    public function handle(AdminAuthLogRepository $repository)
    {
        $this->registerQueryRequest();
        $this->registerQueryRequest();

        $logs = $repository->paginate(
            $repository->searchByQuery(Request::get('query'))
        );

        $logs->transform(function ($item) {
            return new AdminAuthLogResource($item);
        });

        return new ResourceCollection($logs);
    }
}

<?php

namespace OZiTAG\Tager\Backend\Admin\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use OZiTAG\Tager\Backend\Admin\Repositories\AdminAuthLogRepository;
use OZiTAG\Tager\Backend\Auth\Events\TagerSuccessAuthRequest;

class AdminSuccessAuthListener implements ShouldQueue
{

    /**
     * AdminSuccessAuthListener constructor.
     * @param AdminAuthLogRepository $repository
     */
    public function __construct(
        protected AdminAuthLogRepository $repository,
    ) {}

    /**
     * @param TagerSuccessAuthRequest $event
     */
    public function handle(TagerSuccessAuthRequest $event)
    {
        if ($event->provider !== 'administrators') {
            return;
        }

        $model = $this->repository->findByUuid($event->uuid);
        $model && $this->repository->set($model);
        $this->repository->fillAndSave([
            'uuid' => $event->uuid,
            'auth_success' => true,
        ]);
    }
}

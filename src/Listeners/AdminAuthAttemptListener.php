<?php

namespace OZiTAG\Tager\Backend\Admin\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use OZiTAG\Tager\Backend\Admin\Repositories\AdminAuthLogRepository;
use OZiTAG\Tager\Backend\Admin\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Auth\Events\TagerAuthRequest;

class AdminAuthAttemptListener implements ShouldQueue
{

    /**
     * AuthAttemptListener constructor.
     * @param AdminAuthLogRepository $repository
     * @param AdministratorRepository $administratorRepository
     */
    public function __construct(
        protected AdminAuthLogRepository $repository,
        protected AdministratorRepository $administratorRepository,
    ) {}

    /**
     * Handle the event.
     *
     * @param TagerAuthRequest $event
     * @return void
     */
    public function handle(TagerAuthRequest $event)
    {
        if ($event->provider !== 'administrators') {
            return;
        }

        if ($event->email) {
            $admin = $this->administratorRepository->findByEmail($event->email);
        }

        $model = $this->repository->findByUuid($event->uuid);
        $model && $this->repository->set($model);
        $this->repository->fillAndSave([
            'uuid' => $event->uuid,
            'administrator_id' => $admin->id ?? null,
            'grant_type' => $event->grant_type,
            'user_agent' => $event->user_agent,
            'email' => $event->email,
            'ip' => $event->ip,
        ]);
    }
}

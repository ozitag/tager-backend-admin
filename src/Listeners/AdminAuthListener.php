<?php

namespace OZiTAG\Tager\Backend\Admin\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Request;
use Laravel\Passport\Events\AccessTokenCreated;
use OZiTAG\Tager\Backend\Admin\Repositories\SeoPageRepository;

class AdminAuthListener implements ShouldQueue
{
    /**
     * @var SeoPageRepository
     */
    private $repository;

    /**
     * Create the event listener.
     *
     * @param SeoPageRepository $repository
     */
    public function __construct(SeoPageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param AccessTokenCreated $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        $this->repository->fillAndSave([
            'administrator_id' => $event->userId,
            'ip' => Request::ip() ?? '-'
        ]);
    }
}

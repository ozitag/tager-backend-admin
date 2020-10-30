<?php

namespace OZiTAG\Tager\Backend\Admin\Listeners;

use OZiTAG\Tager\Backend\Rbac\Events\TagerRoleDeleted;
use OZiTAG\Tager\Backend\Admin\Repositories\AdministratorRoleRepository;

class DeleteAdminRoleListener
{
    private $repository;

    /**
     * Create the event listener.
     *
     * @param AdministratorRoleRepository $repository
     */
    public function __construct(AdministratorRoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param TagerRoleDeleted $event
     * @return void
     */
    public function handle(TagerRoleDeleted $event)
    {
        $this->repository->deleteRoleLinksById(
            $event->getRoleId()
        );
    }
}

<?php

namespace OZiTAG\Tager\Backend\Admin\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Request;
use Laravel\Passport\Events\AccessTokenCreated;
use OZiTAG\Tager\Backend\Admin\Repositories\AdminAuthLogRepository;
use Laravel\Passport\Token;
use Laravel\Passport\TokenRepository;
use OZiTAG\Tager\Backend\Auth\Scopes\TokenProviderScope;
use OZiTAG\Tager\Backend\User\Repositories\UserAuthLogRepository;

class AdminAuthListener implements ShouldQueue
{
    /**
     * @var AdminAuthLogRepository
     */
    private $repository;

    /**
     * Create the event listener.
     *
     * @param AdminAuthLogRepository $repository
     */
    public function __construct(AdminAuthLogRepository $repository)
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
        $token = Token::withoutGlobalScope(TokenProviderScope::class)->whereId($event->tokenId)->first();
        if(!$token || $token->provider !== 'administrators') {
            return;
        }
        $this->repository->fillAndSave([
            'administrator_id' => $event->userId,
            'ip' => Request::ip() ?? '-'
        ]);
    }
}

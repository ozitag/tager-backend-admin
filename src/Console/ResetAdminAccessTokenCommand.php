<?php

namespace OZiTAG\Tager\Backend\Admin\Console;

use Illuminate\Support\Facades\Hash;
use Ozerich\FileStorage\Services\Random;
use Ozerich\FileStorage\Storage;
use OZiTAG\Tager\Backend\Admin\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Auth\Facades\TagerAuth;
use OZiTAG\Tager\Backend\Auth\Http\Features\AuthFeature;
use OZiTAG\Tager\Backend\Core\Console\Command;
use OZiTAG\Tager\Backend\Mail\Repositories\MailLogRepository;
use OZiTAG\Tager\Backend\Mail\TagerMail;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailAttachments;

class ResetAdminAccessTokenCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'tager:reset-admin-access-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Admin Access Token';

    public function __construct(protected AdministratorRepository $administratorRepository)
    {
        parent::__construct();
    }

    public function handle()
    {
        $randomPassword = Random::GetString(10);
        $randomPasswordHash = Hash::make($randomPassword);

        $adminUser = $this->administratorRepository->first();
        if(!$adminUser){
            $this->error('No admin found');
            return self::FAILURE;
        }

        $this->administratorRepository->set($adminUser)->fillAndSave([
            'password' => $randomPasswordHash
        ]);

        list($accessToken) = TagerAuth::auth(
            $randomPassword,
            $adminUser->email,
            1
        );

        // league/oauth2-server 9: у токена нет __toString(), только toString() (как в tager-backend-auth)
        echo "\n".'Access Token:'."\n\n".$accessToken->toString()."\n\n";

        return self::SUCCESS;
    }
}

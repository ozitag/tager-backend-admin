<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AddDefaultOauthClient extends Migration
{
    /**
     * Клиент админки — публичный, без секрета: экран входа присылает один
     * clientId.
     *
     * Строка собирается по фактической схеме oauth_clients, потому что их
     * теперь две. Passport <= 12 (и всё, что обновлялось с него) держит
     * колонки redirect, password_client, personal_access_client и целый
     * ключ. Passport 13 на чистой установке заводит uuid-ключ и колонки
     * redirect_uris, grant_types — на такой таблице прежний insert падал:
     * половины колонок нет, а ключ сам собой не заполняется.
     *
     * @return void
     */
    public function up()
    {
        $client = [
            'name' => 'Admin Client',
            'revoked' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (Schema::hasColumn('oauth_clients', 'grant_types')) {
            $client['id'] = (string)Str::orderedUuid();
            $client['redirect_uris'] = json_encode(['/']);
            $client['grant_types'] = json_encode(['password', 'refresh_token']);
        } else {
            $client['redirect'] = '/';
            $client['password_client'] = 1;
            $client['personal_access_client'] = 0;
        }

        DB::table('oauth_clients')->insert($client);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

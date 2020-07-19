<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class TagerAdminRenameTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('administrators', 'tager_administrators');
        Schema::rename('administrator_auth_logs', 'tager_administrator_auth_logs');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('tager_administrators', 'administrators');
        Schema::rename('tager_administrator_auth_logs', 'administrator_auth_logs');
    }
}

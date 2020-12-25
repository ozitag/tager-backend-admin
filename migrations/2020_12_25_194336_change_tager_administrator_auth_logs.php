<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTagerAdministratorAuthLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tager_administrator_auth_logs', function (Blueprint $table) {
            $table->string('ip')->nullable()->change();
            $table->text('email')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('grant_type')->nullable();
            $table->boolean('auth_success')->default(false);
            $table->string('uuid')->nullable();
            $table->index('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tager_administrator_auth_logs', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('user_agent');
            $table->dropColumn('grant_type');
            $table->dropColumn('uuid');
            $table->dropColumn('auth_success');
        });
    }
}

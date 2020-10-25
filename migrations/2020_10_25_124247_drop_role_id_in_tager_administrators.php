<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropRoleIdInTagerAdministrators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tager_administrators', function (Blueprint $table) {
            $table->dropColumn('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tager_administrators', function (Blueprint $table) {
            $table->integer('role_id')->default(1);
        });
    }
}

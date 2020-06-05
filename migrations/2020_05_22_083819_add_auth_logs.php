<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrator_auth_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->bigInteger('administrator_id')->unsigned()->nullable();
            $table->timestamp('created_at')->nullable();
            $table->foreign('administrator_id')
                ->references('id')->on('administrators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrator_auth_logs');
    }
}

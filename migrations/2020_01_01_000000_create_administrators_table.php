<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        /*
         * Здесь заводился администратор v.ozierski@ozitag.com с паролем
         * 'admin'. Это значит, что каждая установка пакета поднималась с
         * учёткой, чьи адрес и пароль опубликованы в исходниках, — войти
         * мог кто угодно, кто знает, что проект на TAGER.
         *
         * Первого администратора теперь заводит проект сам. Уже созданную
         * учётку снимает миграция revoke_seeded_administrator.
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}

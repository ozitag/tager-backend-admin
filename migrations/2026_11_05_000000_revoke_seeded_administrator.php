<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Снять учётку, которую до этой версии заводила миграция создания таблицы:
 * v.ozierski@ozitag.com с паролем 'admin'.
 *
 * Пароль лежал в исходниках пакета, то есть на каждой установке TAGER был
 * администратор с публично известными адресом и паролем. Пароль — не вся
 * беда: вход через Google ищет администратора по одному только адресу
 * (GoogleAuthFeature -> authWithoutPassword), так что учётка оставалась
 * проходом внутрь и после смены пароля в конфиге.
 *
 * Удаление мягкое: модель Administrator на SoftDeletes, withTrashed() в
 * пакетах нигде нет, поэтому помеченная запись перестаёт находиться и при
 * входе по паролю, и при входе через Google, но данные и связи (роли, поля,
 * журнал входов) остаются на месте и решение обратимо.
 */
return new class extends Migration {
    private const EMAIL = 'v.ozierski@ozitag.com';

    public function up(): void
    {
        if (!Schema::hasTable('tager_administrators')) {
            return;
        }

        $administrator = DB::table('tager_administrators')
            ->where('email', self::EMAIL)
            ->whereNull('deleted_at')
            ->first();

        if (!$administrator) {
            return;
        }

        /*
         * Трогаем только нетронутую учётку. Если пароль сменили, её завели
         * себе осознанно — удалять чужого администратора мы не вправе, а
         * известный пароль там уже и не стоит.
         *
         * password_verify, а не Hash::check: драйвер хэширования в проекте
         * может быть argon, и тогда Hash::check на bcrypt-хэше бросает
         * исключение — миграция упала бы на ровном месте.
         */
        if (!$administrator->password || !password_verify('admin', $administrator->password)) {
            return;
        }

        DB::table('tager_administrators')
            ->where('id', $administrator->id)
            ->update([
                'deleted_at' => now(),
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        /*
         * Обратно не поднимаем: это учётка с опубликованным паролем, и
         * воскрешать её откатом миграции — ровно та беда, от которой здесь
         * уходим. Кому она нужна, снимет deleted_at руками.
         */
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Adiciona a chave 'sb-based-on-hse' ao enum de base_collections.key.
     * É a coleção do formulário Sebratel (respondido no lugar do HSE padrão,
     * porém avaliado pelo mesmo motor HSE).
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE `base_collections` MODIFY COLUMN `key` ENUM('proart', 'hse', 'organizational-climate', 'sb-based-on-hse') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("DELETE FROM `base_collections` WHERE `key` = 'sb-based-on-hse'");
        DB::statement("ALTER TABLE `base_collections` MODIFY COLUMN `key` ENUM('proart', 'hse', 'organizational-climate') NOT NULL");
    }
};

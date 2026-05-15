<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('proart_indicator', 'organizational_indicator');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('organizational_indicator', 'proart_indicator');
    }
};

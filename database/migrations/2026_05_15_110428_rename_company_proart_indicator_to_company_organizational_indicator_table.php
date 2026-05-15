<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('company_proart_indicator', 'company_organizational_indicator');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('company_organizational_indicator', 'company_proart_indicator');
    }
};

<?php

use App\Enums\PROART\PROARTIndicator;
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
        Schema::create('proart_indicator', function (Blueprint $table) {
            $table->id();
            $table->enum('type', PROARTIndicator::values());
            $table->string('display_name', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proart_indicator');
    }
};

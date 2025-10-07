<?php

use App\Enums\PROART\PROARTControlActionTypes;
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
        Schema::create('proart_control_action_types', function (Blueprint $table) {
            $table->id();
            $table->string('display_name', 100);
            $table->enum('type', PROARTControlActionTypes::values());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proart_control_action_types');
    }
};

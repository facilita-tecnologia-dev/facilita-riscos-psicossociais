<?php

use App\Enums\Campaign\MetodologyType;
use App\Enums\Campaign\CollectionType;
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
        Schema::create('base_collections', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->enum('key', MetodologyType::values());
            $table->enum('type', CollectionType::values());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_collections');
    }
};

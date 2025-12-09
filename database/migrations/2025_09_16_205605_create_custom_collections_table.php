<?php

use App\Enums\Campaign\CollectionType;
use App\Models\Company;
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
        Schema::create('custom_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)->constrained()->onDelete('cascade');
            $table->enum('type', CollectionType::values())->default(CollectionType::ORGANIZATIONAL);
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_collections');
    }
};

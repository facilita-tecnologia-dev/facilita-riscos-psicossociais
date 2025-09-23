<?php

use App\Enums\CollectionFactorTypes;
use App\Enums\GravityTypes;
use App\Enums\RiskTypes;
use App\Models\BaseCollection;
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
        Schema::create('risks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BaseCollection::class)->constrained()->onDelete('cascade');
            $table->string('name', 100);
            $table->enum('type', RiskTypes::values());
            $table->enum('gravity', GravityTypes::values());
            $table->enum('group', CollectionFactorTypes::values());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risks');
    }
};

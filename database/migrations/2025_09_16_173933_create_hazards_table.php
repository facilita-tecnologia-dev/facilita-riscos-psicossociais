<?php

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
        Schema::create('hazards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BaseCollection::class)->constrained()->onDelete('cascade');
            $table->string('name', 100);
            $table->string('type');
            $table->string('gravity');
            $table->string('group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hazards');
    }
};

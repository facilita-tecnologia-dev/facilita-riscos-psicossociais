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
        Schema::create('base_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BaseCollection::class)->constrained()->onDelete('cascade');
            $table->string('group');
            $table->string('statement');
            $table->boolean('inverted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_questions');
    }
};

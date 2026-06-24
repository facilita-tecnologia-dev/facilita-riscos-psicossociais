<?php

use App\Models\BaseQuestion;
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
        Schema::create('base_question_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BaseQuestion::class)->constrained()->cascadeOnDelete();
            $table->string('locale', 10);
            $table->string('statement');
            $table->unique(['base_question_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_question_translations');
    }
};

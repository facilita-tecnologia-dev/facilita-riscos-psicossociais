<?php

use App\Models\BaseQuestion;
use App\Models\Hazard;
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
        Schema::create('question_hazard', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hazard::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(BaseQuestion::class)->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_hazard');
    }
};

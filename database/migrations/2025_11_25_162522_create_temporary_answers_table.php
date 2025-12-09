<?php

use App\Enums\Campaign\CollectionCategory;
use App\Models\Campaign;
use App\Models\User;
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
        Schema::create('temporary_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Campaign::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('question_id');
            $table->enum('question_type', CollectionCategory::values());
            $table->integer('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_answers');
    }
};

<?php

use App\Enums\CollectionTypes;
use App\Models\Campaign;
use App\Models\Company;
use App\Models\User;
use App\Models\UserCollection;
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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Company::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Campaign::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(UserCollection::class)->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('question_id');
            $table->enum('question_type', CollectionTypes::values());
            $table->integer('value');

            $table->index('question_id');
            $table->index('campaign_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};

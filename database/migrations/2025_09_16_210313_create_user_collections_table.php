<?php

use App\Enums\Campaign\CollectionCategory;
use App\Models\Campaign;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.\
     */
    public function up(): void
    {
        Schema::create('user_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Company::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Campaign::class)->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('collection_id');
            $table->enum('type', CollectionCategory::values());
            $table->timestamps();
            $table->index('campaign_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_collections');
    }
};

<?php

use App\Models\Campaign;
use App\Models\Company;
use App\Models\Risk;
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
        Schema::create('cache_psychosocial_global_rating', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Campaign::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Risk::class)->constrained()->onDelete('cascade');
            $table->integer('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache_psychosocial_global_rating');
    }
};

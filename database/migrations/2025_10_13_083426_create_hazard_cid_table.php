<?php

use App\Models\CID;
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
        Schema::create('hazard_cid', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hazard::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(CID::class, 'cid_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hazard_cid');
    }
};

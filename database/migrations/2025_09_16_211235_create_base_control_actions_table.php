<?php

use App\Models\ControlActionType;
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
        Schema::create('base_control_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hazard::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(ControlActionType::class)->constrained()->onDelete('cascade');
            $table->integer('gravity');
            $table->text('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_control_actions');
    }
};

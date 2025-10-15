<?php

use App\Models\ActionPlan;
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
        Schema::create('custom_control_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ActionPlan::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Hazard::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(ControlActionType::class)->nullable();
            $table->integer('gravity');
            $table->text('content');
            $table->string('assignee')->nullable();
            $table->string('deadline')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_control_actions');
    }
};

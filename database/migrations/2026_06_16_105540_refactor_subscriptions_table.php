<?php

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
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('ends_at');
            $table->timestamp('current_period_start')->nullable()->after('started_at');
            $table->timestamp('current_period_end')->nullable()->after('current_period_start');
            $table->boolean('cancel_at_period_end')->default(false)->after('next_billing_at');
            $table->timestamp('scheduled_cancel_at')->nullable()->after('cancel_at_period_end');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->timestamp('ends_at')->nullable();
            $table->dropColumn('current_period_start');
            $table->dropColumn('current_period_end');
            $table->dropColumn('cancel_at_period_end');
            $table->dropColumn('scheduled_cancel_at');
        });
    }
};

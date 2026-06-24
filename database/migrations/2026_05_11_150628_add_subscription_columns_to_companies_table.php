<?php

use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Enums\Subscription\TrialExpiredReason;
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
        Schema::table('companies', function (Blueprint $table) {
            $table->timestamp('trial_started_at')->nullable()->after('updated_at');
            $table->timestamp('trial_ends_at')->nullable()->after('trial_started_at');
            $table->timestamp('trial_expired_at')->nullable()->after('trial_ends_at');
            $table->enum('trial_expired_reason', TrialExpiredReason::values())->nullable()->after('trial_expired_at');

            $table->enum('subscription_status', SubscriptionStatus::values())->nullable()->after('trial_expired_reason');
            $table->enum('access_status', AccessStatus::values())->default(AccessStatus::ACTIVE->value)->after('subscription_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['trial_started_at', 'trial_ends_at', 'trial_expired_at', 'trial_expired_reason', 'subscription_status', 'access_status']);
        });
    }
};

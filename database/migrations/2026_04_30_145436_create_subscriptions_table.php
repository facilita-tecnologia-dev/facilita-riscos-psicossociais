<?php

use App\Enums\Subscription\PaymentType;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)->constrained()->onDelete('cascade');
            $table->integer('employees_count');
            $table->integer('amount');
            $table->enum('type', PaymentType::values())->default(PaymentType::YEARLY->value);
            $table->enum('status', SubscriptionStatus::values())->default(SubscriptionStatus::PENDING->value);

            $table->timestamp('started_at');
            $table->timestamp('next_billing_at')->nullable();

            $table->timestamp('ends_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('ended_at')->nullable();

            $table->string('gateway')->nullable();
            $table->string('gateway_subscription_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};

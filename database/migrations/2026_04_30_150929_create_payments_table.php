<?php

use App\Enums\Subscription\PaymentStatus;
use App\Models\Subscription;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Subscription::class)->constrained()->onDelete('cascade');
            $table->integer('amount');
            $table->timestamp('due_date');
            $table->timestamp('paid_at')->nullable();
            
            $table->enum('status', PaymentStatus::values())->default(PaymentStatus::PENDING->value);
            
            $table->string('external_reference')->nullable();
            $table->integer('paid_amount')->nullable();

            $table->integer('retry_attempts')->default(0);
            $table->timestamp('last_retry_at')->nullable();

            $table->string('invoice_number')->nullable();
            $table->string('gateway')->nullable();
            $table->string('gateway_payment_id')->nullable();
            $table->string('gateway_status')->nullable();
            $table->string('gateway_invoice_url')->nullable();
            $table->string('gateway_receipt_url')->nullable();
            $table->string('gateway_payment_method')->nullable();
            $table->json('gateway_payload')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

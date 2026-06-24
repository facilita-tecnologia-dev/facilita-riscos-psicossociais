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
        Schema::table('payments', function (Blueprint $table) {
            $table->timestamp('created_email_sent_at')->nullable();
            $table->timestamp('due_in_1_day_email_sent_at')->nullable();
            $table->timestamp('due_today_email_sent_at')->nullable();
            $table->timestamp('overdue_3_days_email_sent_at')->nullable();
            $table->timestamp('overdue_7_days_email_sent_at')->nullable();
            $table->timestamp('overdue_15_days_email_sent_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('created_email_sent_at');
            $table->dropColumn('due_in_7_days_email_sent_at');
            $table->dropColumn('due_in_3_days_email_sent_at');
            $table->dropColumn('due_today_email_sent_at');
            $table->dropColumn('overdue_3_days_email_sent_at');
            $table->dropColumn('overdue_7_days_email_sent_at');
            $table->dropColumn('overdue_15_days_email_sent_at');
        });
    }
};

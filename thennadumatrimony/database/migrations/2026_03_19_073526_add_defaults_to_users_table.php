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
        Schema::table('users', function (Blueprint $table) {
            // These were added earlier without defaults
            $table->integer('broker_approval_status')->default(0)->change();
            $table->integer('user_payment_percentage')->default(0)->change();
            $table->integer('target_value')->default(0)->change();
            $table->string('earned_amt')->default('0')->change();
            $table->string('payment_req_data')->default('0')->change();
            $table->integer('earned_amt_status')->default(0)->change();
            $table->string('amt_paid_data')->default('0')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

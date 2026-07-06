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
            $table->string('gender')->nullable()->index();
            $table->date('dob')->nullable();
            $table->string('religion')->nullable()->index();
            $table->string('caste')->nullable()->index();
            $table->string('marital_status')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('phone')->nullable()->unique(); // Using phone for mobile
            $table->string('district')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'dob', 'religion', 'caste', 'marital_status', 'mother_tongue', 'phone', 'district']);
        });
    }
};

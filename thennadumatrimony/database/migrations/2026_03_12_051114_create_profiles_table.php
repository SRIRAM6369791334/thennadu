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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            
            // Step 1: Profile Selection
            $table->string('profile_for')->nullable();
            $table->string('full_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            
            // Step 2: OTP (We won't store OTP in profiles table, maybe handled differently)

            // Step 3: Basic Details
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('height')->nullable();
            $table->string('physical_status')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('eating_habit')->nullable();

            // Step 4: Religion & Location & Horoscope
            $table->string('religion')->nullable();
            $table->string('caste')->nullable();
            $table->string('sub_caste')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->time('birth_time')->nullable();
            $table->string('star')->nullable();
            $table->string('horoscope_path')->nullable();

            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();

            // Step 5: Education & Career
            $table->string('education')->nullable();
            $table->string('college')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('occupation')->nullable();
            $table->string('annual_income')->nullable();
            $table->string('work_location')->nullable();
            
            // Checkbox
            $table->boolean('notifications_enabled')->default(true);

            // Images / Verification
            $table->string('photo_path')->nullable();
            $table->string('selfie_path')->nullable();
            $table->text('interests')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};

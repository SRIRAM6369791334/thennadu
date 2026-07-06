<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            if (!Schema::hasColumn('messages', 'is_abusive')) {
                $table->boolean('is_abusive')->default(false);
            }
            if (!Schema::hasColumn('messages', 'flagged_by_admin')) {
                $table->boolean('flagged_by_admin')->default(false);
            }
        });

        Schema::table('chat_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('chat_settings', 'is_blocked')) {
                $table->boolean('is_blocked')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn(['is_abusive', 'flagged_by_admin']);
        });

        Schema::table('chat_settings', function (Blueprint $table) {
            $table->dropColumn(['is_blocked']);
        });
    }
};

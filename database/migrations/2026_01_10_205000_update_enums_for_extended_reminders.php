<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update user_settings table
        DB::statement("ALTER TABLE user_settings MODIFY COLUMN default_reminder_type ENUM('none', '2_jam', '1_hari', '2_hari', '3_hari') NOT NULL DEFAULT 'none'");

        // Update reminders table
        // Note: keeping 'custom' just in case it was intended for future use, appending new ones
        DB::statement("ALTER TABLE reminders MODIFY COLUMN reminder_type ENUM('2_jam', '1_hari', '2_hari', '3_hari', 'custom') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert user_settings table
        // Warning: This will fail if data contains new enum values. We can't safely revert without data loss or mapping.
        // For now, we will just revert definition but strictly speaking this might be unsafe.
        DB::statement("ALTER TABLE user_settings MODIFY COLUMN default_reminder_type ENUM('none', '2_jam', '1_hari') NOT NULL DEFAULT 'none'");

        // Revert reminders table
        DB::statement("ALTER TABLE reminders MODIFY COLUMN reminder_type ENUM('2_jam', '1_hari', 'custom') NOT NULL");
    }
};

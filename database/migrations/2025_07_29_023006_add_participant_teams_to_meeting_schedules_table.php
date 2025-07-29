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
        Schema::table('meeting_schedules', function (Blueprint $table) {
            $table->json('participant_teams')->nullable()->after('location');
            $table->text('notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meeting_schedules', function (Blueprint $table) {
            $table->dropColumn(['participant_teams', 'notes']);
        });
    }
};

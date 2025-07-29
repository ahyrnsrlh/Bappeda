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
            $table->string('invitation_file_path')->nullable()->after('status');
            $table->string('invitation_original_name')->nullable()->after('invitation_file_path');
            $table->string('invitation_file_size')->nullable()->after('invitation_original_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meeting_schedules', function (Blueprint $table) {
            $table->dropColumn(['invitation_file_path', 'invitation_original_name', 'invitation_file_size']);
        });
    }
};

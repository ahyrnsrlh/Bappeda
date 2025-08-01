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
        Schema::table('meeting_notes', function (Blueprint $table) {
            $table->string('title')->after('meeting_schedule_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meeting_notes', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
};

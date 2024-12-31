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
        Schema::table('uscis_cases', function (Blueprint $table) {
            $table->string('status')->default('pending'); // New status field with default
            $table->text('last_status')->nullable()->change(); // Make last_status nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uscis_cases', function (Blueprint $table) {
            $table->dropColumn('status'); // Remove status field
            $table->text('last_status')->nullable(false)->change(); // Revert last_status to not nullable
        });
    }
};

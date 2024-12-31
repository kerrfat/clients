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
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Client name
            $table->string('email')->unique(); // Client email
            $table->string('phone')->nullable(); // Phone number
            $table->text('address')->nullable(); // Physical address
            $table->string('company')->nullable(); // Company name
            $table->text('notes')->nullable(); // Additional notes
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};

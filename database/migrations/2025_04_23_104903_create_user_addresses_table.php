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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('label'); // e.g., Home, Office
            $table->string('place_name'); // e.g., Koteshwor, New Road
            $table->string('municipality')->nullable();
            $table->string('ward')->nullable();
            $table->string('street')->nullable();
            $table->string('additional_info')->nullable(); // landmarks, directions
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};

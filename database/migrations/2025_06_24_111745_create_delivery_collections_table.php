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
        Schema::create('delivery_collections', function (Blueprint $table) {
            $table->id(); // Primary Key, Auto-increment

            // Foreign key to link to the delivery person (from users table)
            $table->foreignId('delivery_person_id')
                  ->constrained('users') // Assumes your users table is named 'users'
                  ->onDelete('cascade'); // If a delivery user is deleted, their collection records are also deleted

            $table->decimal('amount_collected', 10, 2); // The actual cash amount handed over by the delivery person
            $table->timestamp('collection_date'); // The date/time when the cash was received and recorded
            $table->string('status')->default('Recorded'); // E.g., 'Recorded', 'Reconciled', 'Pending Verification', 'Discrepancy'

            // Foreign key to link to the admin user who recorded this collection
            $table->foreignId('collected_by_user_id')
                  ->nullable() // This can be null if not immediately assigned or if the collecting user is later deleted
                  ->constrained('users')
                  ->onDelete('set null'); // If the admin user is deleted, set this foreign key to null

            $table->text('notes')->nullable(); // Any additional notes about this collection event

            // Date range to specify which period of COD orders this specific collection covers
            $table->date('period_start_date');
            $table->date('period_end_date');

            $table->timestamps(); // Adds `created_at` and `updated_at` columns automatically
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_collections');
    }
};

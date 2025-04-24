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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_address_id')->nullable()->constrained('user_addresses')->nullOnDelete();
    
            $table->enum('delivery_method', ['delivery', 'pickup'])->default('delivery');
    
            // Delivery location snapshot (for consistency even if user edits address later)
            $table->string('place_name')->nullable();        // e.g., Koteshwor
            $table->string('municipality')->nullable();
            $table->string('ward')->nullable();
            $table->string('street')->nullable();
            $table->string('additional_info')->nullable();
    
            $table->decimal('delivery_charge', 10, 2)->nullable(); //null if pickup
            $table->decimal('subtotal', 10, 2); // Total before discounts and taxes
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('tax', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2);
    
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->enum('order_status', ['placed', 'processing', 'shipping', 'shipped', 'cancelled'])->default('placed');
    
            $table->text('notes')->nullable(); // Customer's notes or instructions
    
            // Add the tracking number (unique for each order)
            $table->string('order_tracking_number')->unique();
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

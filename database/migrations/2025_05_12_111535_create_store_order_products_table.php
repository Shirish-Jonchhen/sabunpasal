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
        Schema::create('store_order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_order_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('variant_price_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('quantity');
            $table->decimal('price_at_order_time', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_order_products');
    }
};

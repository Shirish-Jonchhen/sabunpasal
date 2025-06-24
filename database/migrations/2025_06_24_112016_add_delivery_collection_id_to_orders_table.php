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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('delivery_collection_id')
                  ->nullable()
                  ->constrained('delivery_collections') // This links to the new 'delivery_collections' table
                  ->onDelete('set null') // If a delivery_collection record is deleted, clear the link from orders (set to null)
                  ->after('delivery_guy_commission');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropConstrainedForeignId('delivery_collection_id');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['regular_price', 'discounted_price', 'stock_quantity']);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('regular_price', 10, 2)->after('store_id');
            $table->decimal('discounted_price', 10, 2)->nullable()->after('regular_price');
            $table->integer('stock_quantity')->default(0)->after('discounted_price');
        });
    }
};

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
        Schema::table('municipalities', function (Blueprint $table) {
            $table->decimal('delivery_charge', 8, 2)->default(0)->after('municipality_name')->comment('Delivery charge for the municipality');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('municipalities', function (Blueprint $table) {
            //
        });
    }
};

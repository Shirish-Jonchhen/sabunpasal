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
        Schema::table('variant_prices', function (Blueprint $table) {
            if (Schema::hasColumn('variant_prices', 'stock')) {
                $table->dropColumn('stock');
            }

            // 2. Add the 'pieces_per_unit' column.
            //    This defines how many individual pieces are in ONE of this unit type for this specific product variant.
            $table->integer('pieces_per_unit')->default(1)->after('old_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variant_prices', function (Blueprint $table) {
            //
            $table->dropColumn('pieces_per_unit');

            // 2. Re-add the 'stock' column (if it was dropped in up(), for rollback integrity).
            //    Place it back in its original position or where you prefer.
            $table->integer('stock')->default(0)->after('price'); // A
        });
    }
};

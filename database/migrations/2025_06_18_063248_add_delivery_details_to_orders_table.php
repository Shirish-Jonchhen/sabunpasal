<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('delivered_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null')
                ->after('payment_method'); // Or choose an appropriate position

            // Add 'delivered_at' timestamp
            // Nullable because an order isn't delivered immediately upon creation.
            $table->timestamp('delivered_at')->nullable()->after('delivered_by');
            $table->decimal('delivery_guy_commission', 10, 2)->nullable()->after('delivered_at');
            $table->foreignId('delivery_payout_id')
                ->nullable()
                ->constrained('delivery_payouts')
                ->onDelete('set null')
                ->after('delivery_guy_commission');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('delivery_payout_id');
            $table->dropColumn('delivery_guy_commission');
        });
    }
};

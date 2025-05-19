<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE store_orders MODIFY COLUMN payment_status ENUM('unpaid', 'partial', 'paid','refunded') NOT NULL");
    }

    public function down()
    {
        DB::statement("ALTER TABLE store_orders MODIFY COLUMN payment_status ENUM('unpaid', 'partial', 'paid',) NOT NULL");
    }
};

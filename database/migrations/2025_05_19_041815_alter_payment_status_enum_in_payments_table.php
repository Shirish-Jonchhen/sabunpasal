<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AlterPaymentStatusEnumInPaymentsTable extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE payments MODIFY COLUMN payment_status ENUM('pending', 'completed', 'failed', 'cancelled','refunded') NOT NULL");
    }

    public function down()
    {
        DB::statement("ALTER TABLE payments MODIFY COLUMN payment_status ENUM('pending', 'completed', 'failed', 'cancelled') NOT NULL");
    }
}

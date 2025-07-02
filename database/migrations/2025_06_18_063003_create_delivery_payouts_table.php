<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryPayoutsTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_person_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->timestamp('payment_date')->nullable();
            $table->string('status')->default('Pending');
            $table->foreignId('paid_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->date('period_start_date');
            $table->date('period_end_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_payouts');
    }
}
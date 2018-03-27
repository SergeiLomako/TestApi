<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('terminal_id')->nullable();
            $table->string('title')->nullable();
            $table->dateTime('date_receipt')->nullable();
            $table->dateTime('date_complete')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('payment')->default(0);
            $table->tinyInteger('payment_status')->default(0);
            $table->integer('box_number')->nullable();
            $table->integer('seal_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

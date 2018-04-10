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
            $table->unsignedInteger('user_id')->nullable(false);
            $table->unsignedInteger('service_id')->nullable(false);
            $table->unsignedInteger('terminal_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('terminal_id')->references('id')->on('terminals');
            $table->string('title')->nullable();
            $table->dateTime('date_receipt')->nullable();
            $table->dateTime('date_complete')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('payment')->default(0);
            $table->tinyInteger('payment_status')->default(0);
            $table->integer('box_number')->nullable(false);
            $table->integer('seal_number')->nullable(false);
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

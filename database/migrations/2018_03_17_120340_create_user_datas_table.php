<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable(false);
            $table->string('first_name')->nullable(false);
            $table->string('last_name')->nullable(false);
            $table->date('birth_date');
            $table->string('avatar')->nullable();
            $table->string('address')->nullable(false);
            $table->string('city')->nullable(false);
            $table->timestamps();
        });

        Schema::table('user_data', function(Blueprint $table)
        {
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_data');
    }
}

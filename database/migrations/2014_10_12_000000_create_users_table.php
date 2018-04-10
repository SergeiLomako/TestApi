<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login')->nullable();
            $table->string('password')->nullable(false);
            $table->string('email')->nullable(false)->unique();
            $table->string('auth_token')->nullable();
            $table->string('password_reset_token')->nullable();
            $table->string('tel')->nullable(false);
            $table->integer('sms_code')->nullable();
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
        Schema::dropIfExists('users');
    }
}

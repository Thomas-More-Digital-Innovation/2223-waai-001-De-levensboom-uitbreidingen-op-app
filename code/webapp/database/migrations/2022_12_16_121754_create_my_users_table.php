<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->nonNull();
            $table->string('firstname')->nonNull();
            $table->string('surname')->nonNull();
            $table->date('birthdate')->nullable();
            $table->string('email')->nonNull();
            $table->string('password')->nonNull();
            $table->string('phoneNumber')->nullable();
            $table->string('gender')->nullable();
            $table->string('street')->nullable();
            $table->string('houseNumber')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('user_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_users');
    }
};

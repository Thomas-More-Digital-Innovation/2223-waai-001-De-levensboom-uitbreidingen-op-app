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
            $table->foreignId('typeId')->constrained('user_types');
            $table->string('firstname')->nonNull();
            $table->string('surname')->nonNull();
            $table->string('birthdate')->nullable();
            $table->sting('email')->nonNull();
            $table->string('password')->nonNull();
            $table->string('phoneNumber')->nullable();
            $table->string('gender')->nullable();
            $table->string('street')->nullable();
            $table->string('houseNumber')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
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
        Schema::dropIfExists('my_users');
    }
};

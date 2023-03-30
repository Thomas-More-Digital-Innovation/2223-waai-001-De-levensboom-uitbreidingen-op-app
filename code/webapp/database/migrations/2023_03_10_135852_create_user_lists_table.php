<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("user_lists", function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger("client_id")->nonNull();
            $table->UnsignedBigInteger("mentor_id")->nonNull();
            $table->timestamps();

            $table
                ->foreign("client_id")
                ->references("id")
                ->on("users");
            $table
                ->foreign("mentor_id")
                ->references("id")
                ->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("user_lists");
    }
};

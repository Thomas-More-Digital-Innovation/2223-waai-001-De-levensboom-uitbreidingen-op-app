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
        Schema::create("answers", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nonNull();
            $table->unsignedBigInteger("question_id")->nonNull();
            $table->string("answer")->nonNull();
            $table->timestamps();

            $table
                ->foreign("user_id")
                ->references("id")
                ->on("users");
            $table
                ->foreign("question_id")
                ->references("id")
                ->on("questions");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("answers");
    }
};

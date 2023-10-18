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
        Schema::create('question_user_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("question_list_id")->nonNull();
            $table->unsignedBigInteger("user_id")->nonNull();
            $table->boolean("active")->nonNull();
            $table->timestamps();

            $table
            ->foreign("question_list_id")
            ->references("id")
            ->on("question_lists");

            $table
            ->foreign("user_id")
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
        Schema::dropIfExists('question_user_lists');
    }
};

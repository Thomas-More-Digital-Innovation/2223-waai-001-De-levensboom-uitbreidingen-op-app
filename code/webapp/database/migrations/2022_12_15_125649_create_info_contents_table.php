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
        Schema::create('info_contents', function (Blueprint $table) {
            $table->id('infoContentId');
            $table->foreignId('infoId')->constrained('infos');
            $table->string('title');
            $table->string('titleImage')->nullable();
            $table->string('url')->nullable();
            $table->string('shortContent')->nullable();
            $table->string('content')->nullable();
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
        Schema::dropIfExists('info_contents');
    }
};

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
        Schema::create('galeries', function (Blueprint $table) {
            $table->id();
            $table->String('title');
            $table->date('created_date');
            $table->time('created_time');
            $table->string('image_path_galeries');
            $table->unsignedBigInteger('category_galeries_id');
            $table->timestamps();

             $table->foreign('category_galeries_id')->references('id')->on('category_galeries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galeries');
    }
};

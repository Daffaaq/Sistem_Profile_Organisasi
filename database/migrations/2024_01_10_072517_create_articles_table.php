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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->String('title');
            $table->longText('Descriptions');
            $table->date('created_date');
            $table->time('created_time');
            $table->string('image_path_article');
            $table->unsignedBigInteger('category_articles_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('category_articles_id')->references('id')->on('category_articles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};

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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Nama gambar atau deskripsi
            $table->string('path')->nullable(); // Path atau lokasi penyimpanan gambar
            $table->unsignedBigInteger('articles_id');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('galeries_id');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('articles_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('galeries_id')->references('id')->on('galeries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};

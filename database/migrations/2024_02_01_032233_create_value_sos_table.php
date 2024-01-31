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
        Schema::create('value_sos', function (Blueprint $table) {
            $table->id();
            $table->string('name_value_so');
            $table->unsignedBigInteger('jabatan_so_id')->unique();
            $table->timestamps();

            $table->foreign('jabatan_so_id')->references('id')->on('jabatan_sos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('value_sos');
    }
};

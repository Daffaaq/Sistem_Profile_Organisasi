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
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id();
            $table->String('tittle_aspirations');
            $table->longText('description_aspirations');
            $table->date('created_date');
            $table->time('created_time');
            $table->enum('status', ['Todo', 'In progress', 'Done'])->default('Todo');
            $table->unsignedBigInteger('category_aspirations_id');
            $table->timestamps();

            $table->foreign('category_aspirations_id')->references('id')->on('category_aspirations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aspirations');
    }
};

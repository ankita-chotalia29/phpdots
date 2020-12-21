<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('college_id')->unsigned();
            $table->foreign('college_id')->references('id')->on('colleges')->onDelete('cascade')->nullable();
            $table->string('title',200)->nullable();
            $table->integer('contact_no')->unsigned()->nullable();
            $table->string('email',200)->nullable();
            $table->integer('price')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->string('syllabus',200)->nullable();
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
        Schema::dropIfExists('class');
    }
}

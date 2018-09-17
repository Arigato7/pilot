<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->length(10)->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
			$table->integer('course_type_id')->length(10)->unsigned();
			$table->foreign('course_type_id')->references('id')->on('course_types');
			$table->string('name');
			$table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('end_entry_date');
            $table->integer('duration');
			$table->string('place');
			$table->string('description');
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
        Schema::dropIfExists('courses');
    }
}

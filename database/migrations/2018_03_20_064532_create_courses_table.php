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
			$table->integer('course_type_id')->length(10)->unsigned();
			$table->foreign('course_type_id')->references('id')->on('course_types');
			$table->string('name');
			$table->dateTime('start_date');
			$table->dateTime('end_date');
			$table->string('place');
			$table->string('description');
			$table->double('rate', 5, 5)->default(0);
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

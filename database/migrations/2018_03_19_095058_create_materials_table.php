<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->length(10)->unsigned();
			$table->integer('material_type_id')->length(10)->unsigned();
			$table->integer('specialty_id')->length(10)->unsigned();
			$table->integer('subject_id')->length(10)->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('material_type_id')->references('id')->on('material_types');
			$table->foreign('specialty_id')->references('id')->on('specialties');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->string('name');
            $table->string('content');
            $table->string('who_deleted')->nullable();
            $table->string('deleted')->nullable();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
			$table->timestamp('date');
            $table->string('rate')->default('0');
            $table->softDeletes();
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
        Schema::dropIfExists('materials');
    }
}

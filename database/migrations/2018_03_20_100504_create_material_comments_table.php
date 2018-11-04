<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_comments', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('material_id')->length(10)->unsigned();
			$table->integer('user_id')->length(10)->unsigned();
			$table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('description');
            $table->string('review');
			$table->timestamp('date');
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
        Schema::dropIfExists('material_comments');
    }
}

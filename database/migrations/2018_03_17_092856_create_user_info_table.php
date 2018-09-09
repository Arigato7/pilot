<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->length(10)->unsigned();
			$table->integer('education_organization_id')->length(10)->unsigned()->default(1);
			$table->foreign('user_id')->references('id')->on('users');
            $table->foreign('education_organization_id')->references('id')->on('education_organizations');
            $table->integer('position_id')->length(10)->unsigned();
            $table->foreign('position_id')->references('id')->on('positions');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
			$table->string('name');
			$table->string('lastname');
			$table->string('middlename')->nullable();
			$table->string('photo')->nullable();
			$table->text('about')->nullable();
			$table->string('rate')->default('0');
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
        Schema::dropIfExists('user_infos');
    }
}

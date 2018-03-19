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
        Schema::create('user_info', function (Blueprint $table) {
            $table->increments('id');
			$table->foreign('user_id')->references('id')->on('user');
			$table->foreign('organization_id')->references('id')->on('educational_organization');
			$table->string('name');
			$table->string('lastname');
			$table->string('middlename');
			$table->string('photo');
			$table->text('about');
			$table->double('rate', 5, 5);
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
        Schema::dropIfExists('user_info');
    }
}

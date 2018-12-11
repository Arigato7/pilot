<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationalOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shortname')->nullable();
			$table->string('name');
			$table->string('phone');
			$table->string('address');
			$table->string('cite')->nullable();
            $table->string('email');
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('education_organizations');
    }
}

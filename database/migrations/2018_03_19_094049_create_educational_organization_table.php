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
        Schema::create('educational_organization', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->string('phone');
			$table->string('address');
			$table->string('cite');
			$table->string('email');
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
        Schema::dropIfExists('educational_organization');
    }
}

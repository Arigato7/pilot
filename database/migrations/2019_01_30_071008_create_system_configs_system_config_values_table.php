<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemConfigsSystemConfigValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_configs_system_config_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('system_config_id')->length(10)->unsigned();
            $table->foreign('system_config_id')->references('id')->on('system_configs');
            $table->integer('system_config_value_id')->length(10)->unsigned();
            $table->foreign('system_config_value_id')->references('id')->on('system_config_values');
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
        Schema::dropIfExists('system_configs_system_config_values');
    }
}

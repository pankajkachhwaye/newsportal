<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_user_id')->nullable()->unsigned();
            $table->foreign('app_user_id')->references('id')->on('app_users')->onDelete('set null');
            $table->string('device_id');
            $table->string('device_token');
            $table->string('device_type');
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
        Schema::dropIfExists('device_info');
    }
}

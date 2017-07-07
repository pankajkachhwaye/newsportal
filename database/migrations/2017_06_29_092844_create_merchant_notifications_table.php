<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id')->unsigned();
            $table->foreign('merchant_id')->references('id')->on('merchents')->onDelete('cascade')->onUpdate('cascade');
            $table->string('notification_name');
            $table->string('notification_description');
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
        Schema::dropIfExists('merchant_notifications');
    }
}

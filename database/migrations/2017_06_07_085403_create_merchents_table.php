<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('companyName');
            $table->string('location');
            $table->string('title');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('category');
            $table->string('mobileNo');
            $table->string('landlineNo');
            $table->string('webAddress');
            $table->string('profilePic');
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
        Schema::dropIfExists('merchents');
    }
}

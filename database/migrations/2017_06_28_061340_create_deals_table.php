<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('subcat_id')->unsigned();
            $table->foreign('subcat_id')->references('id')->on('sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('merchant_id')->unsigned();
            $table->foreign('merchant_id')->references('id')->on('merchents')->onDelete('cascade')->onUpdate('cascade');

            $table->string('dealtitle');
            $table->string('dealpercent');
            $table->string('dealdescription');

            $table->string('dealstart');
            $table->string('dealend');
            $table->boolean('status');


            $table->string('dealimg1');
            $table->string('dealimg2');
            $table->string('dealimg3');
            $table->string('dealimg4');
            $table->string('dealimg5');

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
        Schema::dropIfExists('deals');
    }
}

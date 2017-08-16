<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('subcat_id')->unsigned();
            $table->foreign('subcat_id')->references('id')->on('sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('news_title');
            $table->string('news_description');
            $table->string('video');
            $table->string('Priority');
            $table->string('city');
            $table->string('image');
            $table->string('country');



            $table->string('source_of_url');



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
        Schema::dropIfExists('products');
    }
}

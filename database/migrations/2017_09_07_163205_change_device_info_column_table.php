<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDeviceInfoColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('device_info', function (Blueprint $table) {
            $table->text('device_id')->change();
            $table->text('device_token')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('device_info', function (Blueprint $table) {
            $table->dropColumn('device_id');
            $table->dropColumn('device_token');
        });
    }
}

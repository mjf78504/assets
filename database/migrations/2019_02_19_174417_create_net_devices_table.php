<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('net_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('maintaindate');
            $table->dateTime('updatetime');

            $table->string('category', 16);
            $table->string('SN', 64);
            $table->string('name', 50);
            $table->string('type', 16);
            $table->string('devicetype', 16);
            $table->string('producer', 100);
            $table->string('supplier', 100);
            $table->float('contractprice', 10, 2);
            $table->string('contractNo', 64);
            $table->string('status', 16);
            $table->string('changestatus', 16);
            $table->string('location', 100);
            $table->string('description', 320);
            $table->string('manageIP', 64);
            $table->string('appIP', 64);
            $table->string('hostname', 64);
            $table->string('project', 64);
            $table->string('level', 16);
            $table->string('statusofrecord', 16);
            $table->string('extend1', 64);
            $table->string('extend2', 64);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('net_devices');
    }
}

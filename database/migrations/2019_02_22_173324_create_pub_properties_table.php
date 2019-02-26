<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('proname', 64);
            $table->string('provalue', 64);
            $table->string('deviceId', 32);
            $table->integer('protype1');
            $table->integer('protype2');
            $table->string('prodesc', 160);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pub_properties');
    }
}

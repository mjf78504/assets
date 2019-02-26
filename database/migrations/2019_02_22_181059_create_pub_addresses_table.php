<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('location');
            $table->integer('position');
            $table->integer('cabinet');
            $table->string('detail', 160);
            $table->string('description', 160);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pub_addresses');
    }
}

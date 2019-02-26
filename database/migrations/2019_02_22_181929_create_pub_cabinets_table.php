<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubCabinetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_cabinets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name', 32);
            $table->string('type', 32);
            $table->string('tag', 64);
            $table->string('SN', 32);
            $table->string('address',160 );
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
        Schema::dropIfExists('pub_cabinets');
    }
}

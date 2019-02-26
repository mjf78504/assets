<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name', 64);
            $table->string('operator', 64);
            $table->string('description', 320);
            $table->string('local', 160);
            $table->string('status', 16);
            $table->datetime('startdate');
            $table->datetime('enddate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pub_contracts');
    }
}

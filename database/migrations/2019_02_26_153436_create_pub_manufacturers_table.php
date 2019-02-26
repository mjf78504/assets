<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubManufacturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_manufacturers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 64);
            $table->string('type', 32);
            $table->string('leader', 64);
            $table->string('linkman', 160);
            $table->integer('personscount');
            $table->string('persons', 320);
            $table->string('description', 320);
            $table->string('extend1');

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
        Schema::dropIfExists('pub_manufacturers');
    }
}

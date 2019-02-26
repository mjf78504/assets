<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name', 64);
            $table->string('nickname', 64);
            $table->string('mobile1', 16);
            $table->string('mobile2', 16);
            $table->integer('phone');
            $table->string('email', 32);
            $table->string('weixin', 32);
            $table->string('qq', 16);
            $table->string('address', 320);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pub_contacts');
    }
}

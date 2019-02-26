<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubOperflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_operflows', function (Blueprint $table) {
            $table->increments('id');

            $table->string('type', 16);
            $table->string('applicant', 64);
            $table->string('operator', 64);
            $table->string('description', 64);
            $table->string('status', 16);
            $table->datetime('updatetime');
            $table->string('deviceId', 64);

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
        Schema::dropIfExists('pub_operflows');
    }
}

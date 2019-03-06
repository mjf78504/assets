<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_projects', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 32);
            $table->string('nickname', 32);
            $table->string('leader', 32);
            $table->string('learderlink', 32);
            $table->string('department', 32)->nullable();
            $table->string('directory', 32)->nullable();
            $table->string('persons', 160)->nullable();
            $table->string('description')->nullable();

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
        Schema::dropIfExists('pub_projects');
    }
}

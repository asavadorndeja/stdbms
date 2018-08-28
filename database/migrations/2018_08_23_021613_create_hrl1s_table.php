<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrl1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrl1s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('hrl1FirstName')->nullable();
            $table->string('hrl1LastName')->nullable();
            $table->string('hrl1Address')->nullable();
            $table->string('hrl1Email')->nullable();
            $table->string('hrl1Tel1')->nullable();
            $table->string('hrl1Tel2')->nullable();
            $table->date('hrl1BirthDate')->nullable();
            $table->string('hrl1ThaiID')->nullable();
            $table->string('hrl1EmeFirstName')->nullable();
            $table->string('hrl1EmeLastName')->nullable();
            $table->string('hrl1EmeAddress')->nullable();
            $table->string('hrl1EmeTel1')->nullable();
            $table->string('hrl1EmeTel2')->nullable();

            $table->string('hrl1Supervisor')->nullable();
            $table->date('hrl1DateStart')->nullable();
            $table->date('hrl1DateEnd')->nullable();

            $table->string('hrl1Role1')->nullable();
            $table->string('hrl1Role2')->nullable();
            $table->string('hrl1Discipline')->nullable();

            $table->string('hrl1Category')->nullable();
            $table->string('hrl1Grade')->nullable();
            $table->string('hrl1Position')->nullable();

            $table->string('create_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrl1s');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePel2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pel2s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tel1Number');
            $table->string('pel2Number');
            $table->string('pel2Title');
            $table->string('pel2Description')->nullable();
            $table->string('pel2Budget')->nullable();
            $table->string('create_by');
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
        Schema::dropIfExists('pel2s');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePel4sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pel4s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tel1id');
            $table->string('tel1Number');
            $table->string('tel1Title');
            $table->integer('pel2id');
            $table->string('pel2Number');
            $table->string('pel2Title');
            $table->date('pel4Date');
            $table->float('pel4Hour');
            $table->string('pel4Remark')->nullable();
            $table->string('pel4Status')->default('Submitted');
            $table->string('pel4StatusLog')->nullable();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->string('approve_by')->nullable();
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
        Schema::dropIfExists('pel4s');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('userUser')->default(1);
            $table->integer('userAD')->default(1);
            $table->integer('userTE')->default(1);
            $table->integer('userPE')->default(1);
            $table->integer('userOU')->default(1);
            $table->integer('userDC')->default(1);
            $table->integer('userHS')->default(1);
            $table->integer('userHR')->default(1);
            $table->integer('userMM')->default(1);
            $table->integer('userQA')->default(1);
            $table->string('create_by')->default('SYSTEM');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTel1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tel1s', function (Blueprint $table) {
          $table->increments('id');
          $table->string('tel1Number');
          $table->string('tel1Client')->nullable();
          $table->string('tel1ClientRef')->nullable();
          $table->string('tel1Title')->nullable();
          $table->string('tel1Service')->nullable();
          $table->string('tel1Phase')->nullable();
          $table->string('tel1Status')->nullable();
          $table->string('tel1Remark')->nullable();
          $table->string('tel1Potential')->nullable();
          $table->string('tel1BidMethod')->nullable();
          $table->string('tel1BidCompetitor')->nullable();
          $table->string('tel1')->nullable();
          $table->date('tel1DateInquiry')->nullable();
          $table->date('tel1DateInquiryDueDate')->nullable();
          $table->date('tel1DateSubmit')->nullable();
          $table->date('tel1DateHold')->nullable();
          $table->date('tel1DateTurnDown')->nullable();
          $table->date('tel1DateAward')->nullable();
          $table->date('tel1DateComplete')->nullable();
          $table->string('tel1ReasonTurndown')->nullable();
          $table->string('tel1SuccessBidder')->nullable();
          $table->double('tel1Price')->nullable();
          $table->string('tel1Currency')->nullable();
          $table->double('tel1CurrencyConversion')->nullable();
          $table->double('tel1PriceTHB')->nullable();
          $table->double('tel1PriceFactor')->nullable();
          $table->double('tel1PriceFactorTHB')->nullable();
          $table->date('tel1FcDateStart')->nullable();
          $table->date('tel1FcDateFinish')->nullable();
          $table->float('tel1FcDuration')->nullable();
          $table->float('tel1FcManPower')->nullable();
          $table->float('tel1FcManHour')->nullable();
          $table->text('tel1Note')->nullable();
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
        Schema::dropIfExists('tel1s');
    }
}

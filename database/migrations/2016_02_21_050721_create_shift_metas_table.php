<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shift_id')->unsigned();

            $table->date('repeat_start')->default(date("Y-m-d"));
            $table->date('repeat_end')->default('2099-12-30');
            $table->integer('repeat_interval')->unsigned();
            $table->string('repeat_year');
            $table->string('repeat_month');
            $table->string('repeat_week');
            $table->string('repeat_weekday');
            $table->string('repeat_day');

            $table->timestamps();

            $table->foreign('shift_id')->references('id')->on('shifts');
        });

        // Schema::create('shift_metas', function (Blueprint $table) {
        //     $table->foreign('shift_id')->references('id')->on('shifts');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shift_metas');
    }
}

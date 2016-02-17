<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnableSoftDeletion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('venues', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('shifts', function (Blueprint $table) {
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('venues', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('shifts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}

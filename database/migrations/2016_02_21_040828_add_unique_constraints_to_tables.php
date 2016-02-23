<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueConstraintsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('role')->unique()->change();
        });

        Schema::table('venues', function (Blueprint $table) {
            $table->string('venue')->unique()->change();
        });

        Schema::table('shift_types', function (Blueprint $table) {
            $table->renameColumn('name', 'type');
        });

        Schema::table('shift_types', function (Blueprint $table) {;
            $table->string('type')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropUnique('role');
        });

        Schema::table('venues', function (Blueprint $table) {
            $table->dropUnique('venue');
        });

        Schema::table('shift_types', function (Blueprint $table) {
            $table->dropUnique('type');
        });

        Schema::table('shift_types', function (Blueprint $table) {
            $table->renameColumn('type', 'name');
        });
    }
}

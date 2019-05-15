<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTblcheckin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         /*Schema::table('tblcheckin', function (Blueprint $table) {
            $table->time('finish_hour')->nullable();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       /* Schema::table('tblcheckin', function (Blueprint $table) {
            $table->time('finish_hour')->default('5:30');
        });*/
    }
}

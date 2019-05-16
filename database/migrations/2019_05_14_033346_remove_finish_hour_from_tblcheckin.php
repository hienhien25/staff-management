<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFinishHourFromTblcheckin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblcheckin', function (Blueprint $table) {
            $table->dropColumn('finish_hour');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tblcheckin', function (Blueprint $table) {
            $table->time('finish_hour')->nullable();
        });
    }
}

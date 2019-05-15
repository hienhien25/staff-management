<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblstatisticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblstatistic', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_month');
            $table->unsignedInteger('id_staff');
            $table->double('total_working_hour')->default(0);
            $table->double('total_leave_hour')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblstatistic');
    }
}

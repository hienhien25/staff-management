<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveContentFromEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('tblemail', function (Blueprint $table) {
            $table->dropColumn('content');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {/*
        Schema::table('tblemail', function (Blueprint $table) {
            $table->string('content');
        });*/
    }
}

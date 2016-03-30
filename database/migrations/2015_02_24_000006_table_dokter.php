<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableDokter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('pegawai_id')->unique()->unsigned();
            $table->integer('poli_id')->unsigned();
        });

        Schema::table('dokter', function ($table) {
            $table->foreign('pegawai_id')->references('id')->on('pegawai');
            $table->foreign('poli_id')->references('id')->on('poli');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dokter');
    }
}

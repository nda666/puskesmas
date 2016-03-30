<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRuangKonsul extends Migration
{
       /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruang_konsul', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('rawat_jalan_id')->unsigned();
            $table->text('pemeriksaan_fisik');
            $table->text('diagnosa');
            $table->enum('kasus',['Baru','Lama']);
            $table->text('keterangan');
            $table->integer('poli_id')->unsigned();
            $table->integer('pegawai_id')->unsigned();
            $table->timestamps();

        });

        Schema::table('ruang_konsul', function ($table) {
            $table->foreign('rawat_jalan_id')->references('id')->on('rawat_jalan');
            $table->foreign('poli_id')->references('id')->on('poli');
            $table->foreign('pegawai_id')->references('id')->on('pegawai');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ruang_konsul');
    }
}

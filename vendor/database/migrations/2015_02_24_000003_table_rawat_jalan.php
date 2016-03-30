<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRawatJalan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawat_jalan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment = 'Nomor ID: Primary Key';
            $table->integer('pasien_id')->unsigned()->comment = 'Foreign key -> pasien.id';
            $table->tinyInteger('progres')->default(0);
            $table->enum('kunjungan',['Baru','Lama']);
            $table->string('kepesertaan', 50);
            $table->integer('pegawai_id')->unsigned()->comment = 'Foreign key -> pegawai.id';
            $table->timestamps();
        });

        Schema::table('rawat_jalan', function ($table) {
            $table->foreign('pasien_id')->references('id')->on('pasien')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('pegawai_id')->references('id')->on('pegawai')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rawat_jalan');
    }
}

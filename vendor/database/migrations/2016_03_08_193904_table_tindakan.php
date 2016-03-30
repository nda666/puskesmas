<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableTindakan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tindakan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('ruang_konsul_id')->unsigned()->unique()->comment = 'Foreign Key Ruang Konsul';
            $table->string('pengobatan');
            $table->text('keterangan');
            $table->integer('pegawai_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('tindakan', function(Blueprint $table){
            $table->foreign('ruang_konsul_id')->references('id')->on('ruang_konsul')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::drop('tindakan');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableResepObat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resep', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('rawat_jalan_id')->unsigned()->comment = 'Foreign key -> rawat_jalan.id';
            $table->integer('obat_id')->unsigned();
            $table->integer('pegawai_id')->unsigned();
            $table->timestamps();

        });

        Schema::table('resep', function ($table) {
                $table->foreign('rawat_jalan_id')->references('id')->on('rawat_jalan')->onDelete('CASCADE')->onUpdate('CASCADE');
                $table->foreign('obat_id')->references('id')->on('obat')->onDelete('CASCADE')->onUpdate('CASCADE');;
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
        Schema::drop('resep');
    }
}

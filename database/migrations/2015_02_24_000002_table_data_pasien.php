<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableDataPasien extends Migration
{
        /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->comment = "Nomor Index";
            $table->string('nama', 30);
            $table->string('no_kartu_keluarga', 50);
            $table->string('kepala_keluarga', 30);
            $table->string('pekerjaan', 30);
            $table->text('alamat');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin',['Laki-Laki', 'Perempuan']);
            $table->string('agama',30);
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
        Schema::drop('pasien');
    }

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablePegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username', 30)->unique()->comment="Username Pegawai";
            $table->string('password', 60)->comment="Password Pegawai";
            $table->string('nama', 30);
            $table->enum('jenis_kelamin',['Laki-Laki', 'Perempuan']);
            $table->string('no_telp', 20);
            $table->date('tgl_lahir');
            $table->string('agama', 10);
            $table->string('alamat', 30);
            $table->string('jabatan', 30);
            $table->text('foto')->nullable();;
            $table->rememberToken()->comment="Remember Pada Login Form";

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pegawai');
    }
}

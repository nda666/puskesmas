<?php

use App\Pegawai;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TablePegawaiSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $jabatan = ['Administrasi', 'Konsultan', 'Apoteker','Dokter'];
        $poli = ['umum', 'gigi', 'kia'];
        $offset_poli = 0;
        for ($i = 0; $i < 6; $i++) {
            $tmp_jabatan = '';
            $uname = '';
            if ($i > 2){
                $prefix = $poli[$offset_poli];
                $offset_poli++;
                $tmp_jabatan = $jabatan[3];
                $uname = $jabatan[3].$prefix;
            } else {
                 $tmp_jabatan = $jabatan[$i];
                 $uname = $jabatan[$i];
            }
            $rand_gend = rand(1,2);
            $pegawai = new Pegawai;
            $pegawai->username = strtolower( $uname );
            $pegawai->password = bcrypt(strtolower( $uname ));
            $pegawai->nama = $faker->firstName($rand_gend) . ' ' . $faker->lastName($rand_gend);
            $pegawai->jenis_kelamin = $rand_gend;
            $pegawai->no_telp = trim($faker->phoneNumber);
            $pegawai->tgl_lahir = $faker->date('Y-m-d', '1990-01-01');
            $pegawai->agama = 'Islam';
            $pegawai->alamat = 'Jln. Bungur XI / 37 Jember';
            $pegawai->jabatan =  $tmp_jabatan ;
            $pegawai->save();
        }
    }
}

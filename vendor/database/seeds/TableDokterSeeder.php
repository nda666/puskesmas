<?php

use Illuminate\Database\Seeder;

class TableDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $poli = ['umum', 'gigi', 'kia'];
        for ($i = 0; $i < 3; $i++){
        	$dokter = new \App\Dokter;
            $index = $i+1;
        	$dt_dokter = \App\Pegawai::where('username','dokter'.$poli[$i])->first();
            $dokter->pegawai_id = $dt_dokter->id;
            $dt_poli = \App\Poli::where('id', $index)->first();
            $dokter->poli_id = $dt_poli->id;
        	$dokter->save();
        }
    }
}

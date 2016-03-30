<?php

use Illuminate\Database\Seeder;

class TablePoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nama_poli = ['Umum', 'Gigi', 'KIA'];
        for ($i = 0; $i < count($nama_poli); $i++){
        	$poli = new \App\Poli;
        	$poli->nama = $nama_poli[$i];
            $poli->save();
        }
    }
}

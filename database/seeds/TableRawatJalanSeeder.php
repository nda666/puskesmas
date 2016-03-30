<?php

use Illuminate\Database\Seeder;

class TableRawatJalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$kepesertaan = ['BPJS / UMUM','AKSES', 'BUMIL', 'Lain - Lain'];
        for ($i=0; $i < 250 ; $i++) {
        	$faker = \Faker\Factory::create();
        		\App\RawatJalan::create([
        			'pasien_id' => $i+1,
        			'kunjungan' => 'Baru',
        			'kepesertaan' => $kepesertaan[rand(0, count($kepesertaan) - 1)],
        			'pegawai_id' => 1,
        			'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
        		]);
        }
    }
}

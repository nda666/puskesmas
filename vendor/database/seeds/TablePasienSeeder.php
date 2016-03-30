<?php

use App\Pasien;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TablePasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $ages = ['Tahun', 'Bulan', 'Hari'];
        $kepesertaan = ['Umum & BPJS', 'AKSESOS', 'AKSESIN', 'AKSES', 'BUMIL', 'ASPRAS'];
        $pekerjaan = ['Petani','PNS', 'Wiraswasta', 'Ibu Rumah Tangga', 'Buruh Pabrik', 'Pelajar', 'Pengangguran', 'Pegawai Swasta'];
        $agama = ['Islam', 'Kristen', 'Katholik', 'Hindu', 'Budha'];
        for ($i=0; $i < 250 ; $i++) {
            
        	$birthday = $faker->date('Y-m-d', '-10 years');

            $date = \Carbon\Carbon::createFromFormat('Y-m-d', $birthday)->addYears(rand(4,10))->format('Y-m-d H:i:s');
            $update = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$date)->addYears(rand(1, 2))->addMonths(rand(1, 11))->format('Y-m-d H:i:s');
        	$pasien = Pasien::create([
        		'nama' => $faker->firstName . ' ' . $faker->lastName,
        		'kepala_keluarga' => $faker->firstName . ' ' . $faker->lastName,
        		'pekerjaan' => $pekerjaan[rand(0, count($pekerjaan) - 1 )],
                'no_kartu_keluarga' => $faker->regexify('[0-9]{10}').$faker->date('Y'),
        		'alamat' => $faker->address,
        		'tgl_lahir' => $birthday,
        		'jenis_kelamin' => rand(1, 2),
                'agama' => $agama[rand(0, count($agama) - 1 )],
                'created_at' => $date,
                'updated_at' => $update,
        	]);
        }
    }
}

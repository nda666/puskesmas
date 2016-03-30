<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        $this->call(TablePegawaiSeed::class);
        $this->call(TablePasienSeeder::class);
        $this->call(TablePoliSeeder::class);
        $this->call(TableDokterSeeder::class);
        $this->call(TableRawatJalanSeeder::class);
        $this->call(TableObatSeeder::class);
    }
}

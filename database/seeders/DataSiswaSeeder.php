<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DataSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\DataSiswa::create([
            'name' => 'Ibnu Amri Thaher',
            // 'value' => "[100, 80, 50, 20, 70]",
        ]);
        \App\Models\DataSiswa::create([
            'name' => 'Ahmad Rizal',
            // 'value' => "[100, 80, 50, 20, 70]",
        ]);
        \App\Models\DataSiswa::create([
            'name' => 'Teguh Satria',
            // 'value' => "[100, 80, 50, 20, 70]",
        ]);
        \App\Models\DataSiswa::create([
            'name' => 'Latif Setiawan',
            // 'value' => "[100, 80, 50, 20, 70]",
        ]);
        \App\Models\DataSiswa::create([
            'name' => 'Ahmad Gunawan',
            // 'value' => "[100, 80, 50, 20, 70]",
        ]);
        \App\Models\DataSiswa::create([
            'name' => 'Daniel',
            // 'value' => "[100, 80, 50, 20, 70]",
        ]);
        \App\Models\DataSiswa::create([
            'name' => 'Sumanto',
            // 'value' => "[100, 80, 50, 20, 70]",
        ]);
        \App\Models\DataSiswa::create([
            'name' => 'Arif',
            // 'value' => "[100, 80, 50, 20, 70]",
        ]);
        \App\Models\DataSiswa::create([
            'name' => 'Renal',
            // 'value' => "[100, 80, 50, 20, 70]",
        ]);
        \App\Models\DataSiswa::create([
            'name' => 'Riska',
            // 'value' => "[100, 80, 50, 20, 70]",
        ]);
    }
}

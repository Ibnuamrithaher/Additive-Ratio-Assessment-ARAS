<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DataKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\DataKriteria::create([
            'title' => 'C1',
            'description' => 'Nilai Bahasa Indonesia',
            'weight' => 22.5,
            'type' => 'benefit',
        ]);
        \App\Models\DataKriteria::create([
            'title' => 'C2',
            'description' => 'Nilai Matematika',
            'weight' => 22.5,
            'type' => 'benefit',
        ]);
        \App\Models\DataKriteria::create([
            'title' => 'C3',
            'description' => 'Nilai IPA',
            'weight' => 22.5,
            'type' => 'benefit',
        ]);
        \App\Models\DataKriteria::create([
            'title' => 'C4',
            'description' => 'Nilai Bahasa Inggris',
            'weight' => 22.5,
            'type' => 'benefit',
        ]);
        \App\Models\DataKriteria::create([
            'title' => 'C5',
            'description' => 'Nilai Mengaji',
            'weight' => 10,
            'type' => 'benefit',
        ]);
    }
}

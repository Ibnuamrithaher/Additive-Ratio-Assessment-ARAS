<?php

namespace App\Repositories;

use App\Models\DataKriteria;
use App\Models\DataSiswa;

class DataSiswaRepository
{

    public function get($table_search = "")
    {
        $data_siswa = DataSiswa::with('data_kriteria')->select('id', 'name')->where('name', 'LIKE', '%' . $table_search . '%')->paginate(10);
        // dd('stop');
        return $data_siswa;
    }

    public function store($data)
    {

        $data_kriteria = DataKriteria::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'weight' => $data['weight'],
            'type' => $data['type']
        ]);

        return $data_kriteria->fresh();
    }

    public function update($data)
    {
        $post = DataKriteria::findOrFail($data['id']);
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->weight = $data['weight'];
        $post->type = $data['type'];
        $post->save();
        return $post->fresh();
    }

    public function find_by_id($id)
    {
        $data_siswa = DataSiswa::findOrFail($id);
        return $data_siswa;
    }

    public function delete($id)
    {
        $post = DataKriteria::findOrFail($id);
        $post->delete();

        return "Data Berhasil Di Hapus";
    }
}

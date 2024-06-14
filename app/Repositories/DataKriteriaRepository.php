<?php

namespace App\Repositories;

use App\Models\DataKriteria;
use App\Models\DataSiswa;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class DataKriteriaRepository
{

    public function get($table_search = "")
    {
        $data_kriteria = DataKriteria::query()->select('id', 'title', 'description', 'weight', 'type')->where('title', 'LIKE', '%' . $table_search . '%')->paginate(10);
        return $data_kriteria;
    }

    public function store($data)
    {

        DB::beginTransaction();
        try {
            $data_kriteria = DataKriteria::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'weight' => $data['weight'],
                'type' => $data['type']
            ]);

            $data_siswa = DataSiswa::all()->pluck('id')->toArray();
            $data_kriteria->data_siswa()->attach($data_siswa, ['value' => 0]);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }


        return $data_kriteria->fresh();
    }

    public function update($data)
    {
        $data_kriteria = DataKriteria::findOrFail($data['id']);
        $data_kriteria->title = $data['title'];
        $data_kriteria->description = $data['description'];
        $data_kriteria->weight = $data['weight'];
        $data_kriteria->type = $data['type'];
        $data_kriteria->save();
        return $data_kriteria->fresh();
    }

    public function find_by_id($id)
    {
        $data_kriteria = DataKriteria::findOrFail($id);
        return $data_kriteria;
    }

    public function delete($id)
    {
        $data_kriteria = DataKriteria::findOrFail($id);
        $data_kriteria->delete();
        $data_kriteria->data_siswa()->detach();
        return "Data Berhasil Di Hapus";
    }
}

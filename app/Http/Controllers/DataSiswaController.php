<?php

namespace App\Http\Controllers;

use App\Models\DataKriteria;
use App\Models\DataSiswa;
use Illuminate\Http\Request;
use App\Repositories\DataSiswaRepository;


class DataSiswaController extends Controller
{
    private $datasiswaRepository;
    public function __construct(DataSiswaRepository $datasiswaRepository)
    {
        $this->datasiswaRepository =  $datasiswaRepository;
    }

    public function index(Request $request)
    {
        // $data_siswa = DataSiswa::with('data_kriteria')->find(1);
        // dd($data_siswa->data_kriteria[1]->pivot->value);
        $datalriterias = DataKriteria::get();
        if (count($datalriterias) == 0) {
            return redirect()->route('datakriteria.index')->withErrors('Silahkan buat data kriteria terlebih dahulu !');
        }
        // dd('stop');
        $data_siswa = $this->datasiswaRepository->get($request->table_search);
        return view('data_siswa.index', compact('data_siswa', 'datalriterias'));
    }

    public function create()
    {
        $datalriterias = DataKriteria::get();
        return view('data_siswa.create', compact('datalriterias'));
    }

    public function store(Request $request)
    {
        $data_siswa = DataSiswa::create([
            'name' => $request->name,
        ]);

        $data = $request->except([
            'name',
            '_token'
        ]);
        foreach ($data as $key => $value) {
            $data_siswa->data_kriteria()->attach([$key], ['value' => $value]);
        };

        return redirect()->route('datasiswa.index')->withSuccess('Berhasil Menambah data !');
    }

    public function edit($id)
    {
        $data_siswa = $this->datasiswaRepository->find_by_id($id);
        return view('data_siswa.edit', compact('data_siswa'));
    }

    public function update(Request $request, $id)
    {

        $data_siswa = DataSiswa::findOrFail($id);
        $data_siswa->name = $request->name;
        $data_siswa->save();

        $data = $request->except([
            '_method',
            '_token',
            'name'
        ]);

        foreach ($data as $key => $value) {
            $datakriteria_datasiswa[$key] = array('value' => $value);
        }
        // $data_siswa->data_kriteria()->sync([9 => ["value" => 20]]);
        $data_siswa->data_kriteria()->sync($datakriteria_datasiswa);
        return redirect()->route('datasiswa.index')->withSuccess('Update data berhasil !');
    }

    public function destroy($id)
    {
        $data_siswa = DataSiswa::findOrFail($id);
        $data_siswa->delete();
        $data_siswa->data_kriteria()->detach();
        return redirect()->back()->withSuccess('Berhasil menghapus data !');
    }
}

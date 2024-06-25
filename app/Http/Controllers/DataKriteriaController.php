<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DataKriteriaRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class DataKriteriaController extends Controller
{
    private $datakriteriaRepository;
    public function __construct(DataKriteriaRepository $datakriteriaRepository)
    {
        $this->datakriteriaRepository =  $datakriteriaRepository;
    }

    public function index(Request $request)
    {
        $datakriteria = $this->datakriteriaRepository->get($request->table_search);
        return view('data_kriteria.index', compact('datakriteria'));
    }

    public function create()
    {
        return view('data_kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:data_kriterias,title',
            'description' => 'required',
            'weight' => 'required|numeric|min:0',
            'type' => 'required|in:benefit,cost'
        ], [
            'title.required' => 'Title Kosong !',
            'title.unique' => 'Title sudah ada !',
            'description.required' => 'Deskripsi Kosong !',
            'weight.required' => 'Bobot Kosong !',
            'type.required' => 'Sifat Kosong !',
        ]);

        $data = $request->only([
            'title',
            'description',
            'weight',
            'type'
        ]);

        try {
            $this->datakriteriaRepository->store($data);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('datakriteria.index')->withSuccess('Berhasil Menambah data !');
    }

    public function edit($id)
    {
        $datakriteria = $this->datakriteriaRepository->find_by_id($id);
        return view('data_kriteria.edit', compact('datakriteria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:data_kriterias,title,' . $id . ',id',
            'description' => 'required',
            'weight' => 'required|numeric|min:0',
            'type' => 'required|in:benefit,cost'
        ], [
            'title.required' => 'Title Kosong !',
            'title.unique' => 'Title sudah ada !',
            'description.required' => 'Deskripsi Kosong !',
            'weight.required' => 'Bobot Kosong !',
            'type.required' => 'Sifat Kosong !',
        ]);

        $data = array_merge($request->only([
            'title',
            'description',
            'weight',
            'type'
        ]), array(
            "id" => $id
        ));

        try {
            $this->datakriteriaRepository->update($data);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('datakriteria.index')->withSuccess('Update data berhasil !');
    }

    public function destroy($id)
    {
        $post = $this->datakriteriaRepository->delete($id);
        return redirect()->back()->withSuccess('Berhasil menghapus data !');
    }
}

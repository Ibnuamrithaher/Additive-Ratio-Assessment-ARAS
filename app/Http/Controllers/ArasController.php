<?php

namespace App\Http\Controllers;

use App\Models\DataKriteria;
use App\Models\DataSiswa;
use Illuminate\Http\Request;

class ArasController extends Controller
{
    public function index(Request $request)
    {
        $datakriteria = DataKriteria::all();
        $data_siswas = DataSiswa::all();
        if (count($datakriteria) == 0) {
            return redirect()->route('datakriteria.index')->withErrors('Silahkan isi data kriteria terlebih dahulu !');
        } elseif (count($data_siswas) == 0) {
            return redirect()->route('datasiswa.create')->withErrors('Silahkan isi data kriteria terlebih dahulu !');
        }

        $alternatif = array();
        foreach ($data_siswas as $key => $siswa) {
            array_push($alternatif, array());
            foreach ($siswa->data_kriteria as  $data_kriteria) {
                array_push($alternatif[$key], $data_kriteria->pivot->value);
            }
        }

        // Mencari nilai A0
        $A0 = array();
        foreach ($datakriteria as $index => $kriteria) {
            if ($kriteria->type == 'benefit') {
                $nili_max = max(array_column($alternatif, $index)) / 1;
                array_push($A0, $nili_max);
            } else {
                $nili_min = min(array_column($alternatif, $index)) / 1;
                array_push($A0, $nili_min);
            }
        }
        array_unshift($alternatif, $A0);
        //Normalisasi
        $normalisasi = array();
        foreach ($alternatif as $key => $value) {
            array_push($normalisasi, array());
            foreach ($datakriteria as $key1 => $value1) {
                if ($value1->type == 'benefit') {
                    array_push($normalisasi[$key], round($value[$key1]  / array_sum(array_column($alternatif, $key1)), 3));
                } else {
                    array_push($normalisasi[$key], round((1 / $value[$key1]) / array_sum(array_map(function ($value) {
                        return 1 / $value;
                    }, array_column($alternatif, $key1))), 3));
                }
            }
        }
        //Mengalikan dengan Bobot
        foreach ($normalisasi as $key => $value) {
            foreach ($datakriteria as $key1 => $value1) {
                $normalisasi[$key][$key1] = round($normalisasi[$key][$key1] * $value1->weight, 3);
            }
        }
        //Menghitung nilai Utilitas
        foreach ($normalisasi as $key => $value) {
            array_push($normalisasi[$key], round(array_sum($value), 3));
            if ($key != 0) {
                // array_push($normalisasi[$key], round(end($normalisasi[$key]) / end($normalisasi[0])), 3);
                array_push($normalisasi[$key], round(end($normalisasi[$key]) / end($normalisasi[0]), 3));
            }
        }
        foreach ($data_siswas as $key => $value) {
            array_push($normalisasi[$key + 1], $value->name);
        }

        $normalisasi = array_slice($normalisasi, 1);

        // Mengambil kolom keempat sebagai array terpisah
        $dsc_column = array_column($normalisasi, count($datakriteria) + 1);

        // Mengurutkan array $array2D berdasarkan nilai kolom keempat
        array_multisort($dsc_column, SORT_DESC, $normalisasi);
        // dd($array2D, $column4);
        return view('rangking.index', compact('normalisasi', 'datakriteria'));
    }
}

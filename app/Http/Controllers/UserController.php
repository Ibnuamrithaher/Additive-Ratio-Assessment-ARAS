<?php

namespace App\Http\Controllers;

use App\Models\DataKriteria;
use App\Models\DataSiswa;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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

        if ($request->table_search) {
            $users = User::where('level', 'Users')->where('name', 'LIKE', '%' . $request->table_search . '%')->paginate(10);
        } else {
            $users = User::where('level', 'Users')->paginate(10);
        }
        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'email' => 'required|unique:users,email,' . $id . ',id',
            'password' => 'required',
        ], [
            'email.required' => 'Email Kosong !',
            'email.unique' => 'Email sudah ada !',
            'password.required' => 'Password Kosong !',
        ]);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->key = $request->password;
        $user->save();
        return redirect()->route('users.index')->withSuccess('Update data berhasil !');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;
    protected $table = 'data_siswas';
    protected $guarded = ['id'];

    public function data_kriteria()
    {
        return $this->belongsToMany(DataKriteria::class, 'datakriteria_datasiswas', 'data_siswa_id', 'data_kriteria_id', 'id', 'id')->withPivot('value');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

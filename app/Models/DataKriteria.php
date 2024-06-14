<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKriteria extends Model
{
    use HasFactory;
    protected $table = 'data_kriterias';
    protected $guarded = ['id'];

    public function data_siswa()
    {
        return $this->belongsToMany(DataSiswa::class, 'datakriteria_datasiswas', 'data_kriteria_id', 'data_siswa_id', 'id', 'id')->withPivot('value');
    }
}

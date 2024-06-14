<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKriteriaDataSiswa extends Model
{
    use HasFactory;
    protected $table = 'datakriteria_datasiswas';
    protected $guarded = ['id'];
}

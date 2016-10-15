<?php

namespace App\Mahasiswa;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $fillabe = ['NRP','Nama','Email'];
}

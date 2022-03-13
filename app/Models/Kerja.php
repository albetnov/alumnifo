<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerja extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'jenis_kelamin', 'nama_perusahaan', 'jabatan', 'tahun_kerja', 'gambar'];
}

<?php

namespace App\Models;

use Database\Factories\KerjaKuliahFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class KerjaKuliah extends Model
{
    use HasFactory;
    use HasSlug;
    use Searchable;

    protected $fillable = ['name', 'jenis_kelamin', 'nama_perusahaan', 'nama_universitas', 'jabatan', 'jurusan', 'gambar', 'dibuat', 'tahun_kerja'];

    #[SearchUsingFullText(['name', 'nama_perusahaan', 'jabatan', 'nama_universitas', 'jurusan'])]
    public function toSearchableArray()
    {
        return [
            'name'             => $this->name,
            'nama_perusahaan'  => $this->nama_perusahaan,
            'nama_universitas' => $this->nama_universitas,
            'jabatan'          => $this->jabatan,
            'jurusan'          => $this->jurusan,
            'tahun_kerja'      => $this->tahun_kerja,
            'dibuat'           => $this->dibuat,
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function newFactory()
    {
        return KerjaKuliahFactory::new();
    }
}

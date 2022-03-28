<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\{HasSlug, SlugOptions};

class MencariKerja extends Model
{
    use HasFactory, HasSlug, Searchable;

    protected $fillable = ['name','jenis_kelamin','alamat','alasan_mencari_kerja','kontak','dibuat','gambar'];

    #[SearchUsingFullText(['name','alamat','alasan_mencari_kerja','kontak'])]
    public function toSearchableArray()
    {
        return [
            'name'                  => $this->name,
            'alamat'                => $this->alamat,
            'alasan_mencari_kerja'  => $this->alasan_mencari_kerja,
            'kontak'                => $this->kontak,
            'dibuat'                => $this->dibuat,
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
}
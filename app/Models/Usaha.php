<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Usaha extends Model
{
    use HasFactory;
    use HasSlug;
    use Searchable;

    protected $fillable = ['name', 'jenis_kelamin', 'jenis_usaha', 'alamat_usaha', 'tahun_usaha', 'gambar', 'dibuat'];

    #[SearchUsingFullText(['name', 'jenis_usaha', 'alamat_usaha'])]
    public function toSearchableArray()
    {
        return [
            'name'                 => $this->name,
            'jenis_usaha'          => $this->jenis_usaha,
            'alamat_usaha'         => $this->alamat_usaha,
            'dibuat'               => $this->dibuat,
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

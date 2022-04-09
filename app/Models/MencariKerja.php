<?php

namespace App\Models;

use Database\Factories\MencariKerjaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class MencariKerja extends Model
{
    use HasFactory;
    use HasSlug;
    use Searchable;

    protected $fillable = ['name', 'jenis_kelamin', 'alamat', 'alasan_mencari_kerja', 'kontak', 'dibuat', 'gambar', 'id_request'];

    #[SearchUsingFullText(['name', 'alamat', 'alasan_mencari_kerja', 'kontak'])]
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

    /**
     * Scope a query to shows user without request or user with approved request.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCleanRequest($query)
    {
        return $query->with('request')->whereNull('id_request')->orWhereHas('request', function ($q) {
            return $q->accepted();
        });
    }

    public function request()
    {
        return $this->belongsTo(Request::class, 'id_request', 'id');
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
        return MencariKerjaFactory::new();
    }
}

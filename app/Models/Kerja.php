<?php

namespace App\Models;

use Database\Factories\KerjaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Kerja extends Model
{
    use HasFactory;
    use Searchable;
    use HasSlug;
    protected $fillable = ['name', 'jenis_kelamin', 'nama_perusahaan', 'jabatan', 'tahun_kerja', 'gambar', 'dibuat', 'id_request'];

    #[SearchUsingFullText(['name', 'nama_perusahaan', 'jabatan', 'tahun_kerja', 'dibuat'])]
    public function toSearchableArray()
    {
        return [
            'name'            => $this->name,
            'nama_perusahaan' => $this->nama_perusahaan,
            'jabatan'         => $this->jabatan,
            'tahun_kerja'     => $this->tahun_kerja,
            'dibuat'          => $this->dibuat,
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

    protected static function newFactory()
    {
        return KerjaFactory::new();
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

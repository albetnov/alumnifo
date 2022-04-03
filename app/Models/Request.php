<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

class Request extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['table_type', 'user_id', 'status', 'handled_by'];

    #[SearchUsingFullText(['table_type'])]
    public function toSearchableArray()
    {
        return [
            'table_type' => $this->table_type,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'handled_by' => $this->handled_by,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

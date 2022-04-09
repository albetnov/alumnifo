<?php

namespace App\Models;

use Database\Factories\PublicContactFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

class PublicContact extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'email', 'subject', 'message'];

    #[SearchUsingFullText(['name', 'email', 'subject', 'message'])]
    public function toSearchableArray()
    {
        return [
            'name'      => $this->name,
            'email'     => $this->email,
            'subject'   => $this->subject,
            'message'   => $this->message,
        ];
    }

    protected static function newFactory()
    {
        return PublicContactFactory::new();
    }
}

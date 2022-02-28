<?php

namespace App\Models;

use Database\Factories\PublicContactFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicContact extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'subject', 'message'];

    protected static function newFactory()
    {
        return PublicContactFactory::new();
    }
}

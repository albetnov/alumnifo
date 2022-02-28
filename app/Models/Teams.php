<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'desc', 'link_twitter', 'link_ig', 'link_fb', 'link_in', 'photo'];
}

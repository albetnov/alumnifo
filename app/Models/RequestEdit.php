<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestEdit extends Model
{
    use HasFactory;
    protected $fillable = ['id_container', 'id_user', 'table_type', 'id_table', 'status', 'handled_by'];

    public function container()
    {
        return $this->belongsTo(Container::class, 'id_container', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}

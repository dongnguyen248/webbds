<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articel extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'slug', 'type_id', 'user_id', 'photo'];

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\Type', 'type_id', 'id');
    }
}

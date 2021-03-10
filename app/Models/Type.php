<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','slug','category_id','photo'
    ];
    public function category(){

        return $this->belongsTo(Category::class);
    }
    public function article()
    {
        return $this->hasMany('App\Models\Article', 'id', 'type_id');
    }
}

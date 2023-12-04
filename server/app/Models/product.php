<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    public $timestamps = false;

    public function subCategory(){
        return $this->hasMany(Subcategories::class);
    }

    public function issues(){
        return $this->belongsToMany(Issues::class);
    }
}

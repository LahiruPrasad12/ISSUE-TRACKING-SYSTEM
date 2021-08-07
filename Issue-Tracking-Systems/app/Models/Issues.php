<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    use HasFactory;

    protected $table = "issues";

    public function comments(){
        return $this->hasMany(Comments::class);
    }

    public function images(){
        return $this->hasMany(Images::class);
    }

    public function category(){
        return $this->belongsToMany(Category::class);
    }
}

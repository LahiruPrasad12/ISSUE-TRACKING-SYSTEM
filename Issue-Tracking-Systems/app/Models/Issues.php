<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    use HasFactory;

    protected $table = "issues";
    public $timestamps = false;

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comments::class,'issue_id');
    }

    public function images(){
        return $this->hasMany(Images::class);
    }

    public function category(){
        return $this->belongsToMany(Category::class);
    }

    public function Subcategory(){
        return $this->belongsToMany(Subcategories::class);
    }




}

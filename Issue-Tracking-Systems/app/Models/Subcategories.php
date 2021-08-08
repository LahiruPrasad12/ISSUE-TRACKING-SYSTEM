<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategories extends Model
{
    use HasFactory;

    protected $table = "subcategories";
    public $timestamps = false;

    public function category(): string
    {
        return $this.$this->belongsTo(Category::class);
    }

    public function issues(){
        return $this->belongsToMany(Issues::class);
    }
}

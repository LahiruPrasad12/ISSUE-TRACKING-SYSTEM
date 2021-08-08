<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    public $timestamps = false;

    public function subCategory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Subcategories::class,'cat_ID');
    }

    public function issues(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Issues::class,'issue_categories','cat_id','issue_id');
    }
}

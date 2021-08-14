<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    public $timestamps = false;

    protected $fillable = [
        'name', 'description'
    ];


    //This method used to make one to many relationship with category and sub category models
    public function subCategory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Subcategories::class,'cat_ID');
    }


    //This method used to make many to many relationship with issues and sub category models
    public function issues(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Issues::class,'issue_categories','cat_id','issue_id');

    }
}

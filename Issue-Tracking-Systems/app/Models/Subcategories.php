<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategories extends Model
{
    use HasFactory;

    protected $table = "subcategories";
    public $timestamps = false;


    protected $fillable = [
        'name','description','cat_ID'
    ];


    //This method used to make one to many relationship with category and  sub category model
    public function category(): string
    {
        return $this.$this->belongsTo(Category::class);
    }


    //This method used to make many to many relationship with sub category and  issues model
    public function issues(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Issues::class,'issue__subcategories','cat_id','issue_id');
    }
}

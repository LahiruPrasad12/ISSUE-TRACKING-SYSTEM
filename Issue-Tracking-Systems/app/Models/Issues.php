<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Issues extends Model
{
    use HasFactory;

    protected $table = "issues";
    public $timestamps = false;


    protected $fillable = [
        'title','body','uuid','slug'
    ];

    //This method used to make one to many relationship with issue and  comment model
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comments::class,'issue_id');
    }




    //This method used to make one to many relationship with issue and  images model
    public function images():MorphMany{
        return $this->morphMany(Images::class,'imageable');
    }


    //This method used to make many to many relationship with category and  issues model
    public function category(){
        return $this->belongsToMany(Category::class);

    }

    //This method used to make many to many relationship with sub category and  issues model
    public function Subcategory(){
        return $this->belongsToMany(Subcategories::class);
    }






}

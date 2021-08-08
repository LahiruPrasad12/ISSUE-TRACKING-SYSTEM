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


    public function category(): string
    {
        return $this.$this->belongsTo(Category::class,'');
    }

    public function issues(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Issues::class,'issue__subcategories','cat_id','issue_id');
    }
}

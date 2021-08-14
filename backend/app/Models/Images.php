<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Images extends Model
{
    use HasFactory;

    protected $table = "images";
    public $timestamps = false;

    protected $fillable = [
        'imagable_type','imagable_id','size','path','name','extension','issue_id','comment_id'
    ];
//
//    //This method used to make one to many relationship with issue and  image model
//    public function issues()
//    {
//        return $this.$this->belongsTo(Issues::class,'issue_id');
//    }
//
//    //This method used to make one to many relationship with comment and  images model
//    public function comments()
//    {
//        return $this.$this->belongsTo(Comments::class,'comment_id');
//    }

    public function imageable():MorphTo{
        return $this->morphTo();
    }

}

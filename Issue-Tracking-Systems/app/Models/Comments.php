<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = "comments";
    public $timestamps = false;

    protected $fillable = [
        'body','issue_id'
    ];

    //This method used to make one to many relationship with issues and comment models
    public function issues(): string
    {
        return $this.$this->belongsTo(Issues::class);
    }

    //This method used to make one to many relationship with comment and  images model
    public function images(){
        return $this->hasMany(Images::class,'comment_id');
    }



}

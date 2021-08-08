<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = "comments";
    public $timestamps = false;

    public function issues(): string
    {
        return $this.$this->belongsTo(Issues::class);
    }

    public function images(){
        return $this->hasMany(Images::class,'comment_id');
    }



}

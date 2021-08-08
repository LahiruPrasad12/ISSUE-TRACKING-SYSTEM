<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $table = "images";

    protected $fillable = [
        'imagable_type', 'imagable_id'
    ];

    public function issues()
    {
        return $this.$this->belongsTo(Issues::class,'issue_id');
    }

    public function comments()
    {
        return $this.$this->belongsTo(Comments::class,'comment_id');
    }

}

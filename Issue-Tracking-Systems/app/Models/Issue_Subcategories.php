<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue_Subcategories extends Model
{
    use HasFactory;

    protected $table = "issue__subcategories";
    public $timestamps = false;

    protected $fillable = [
        'cat_id','issue_id'
    ];
}

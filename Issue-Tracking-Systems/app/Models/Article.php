<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable=['body'];
    public $timestamps = false;

    public function commonts():MorphMany{
        return $this->morphMany(Commont::class,'commontable');
    }
}

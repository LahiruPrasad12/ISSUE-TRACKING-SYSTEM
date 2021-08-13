<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Commont extends Model
{
    use HasFactory;

    protected $fillable=['body'];
    public $timestamps = false;

    public function commontable():MorphTo{
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $table = "images";

    public function issues(): string
    {
        return $this.$this->belongsTo(Issues::class);
    }

    public function comment(): string
    {
        return $this.$this->belongsTo(Comments::class);
    }
}

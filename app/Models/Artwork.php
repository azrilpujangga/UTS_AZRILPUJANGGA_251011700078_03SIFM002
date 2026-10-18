<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    protected $fillable = [
        'title',
        'artist',
        'year',
        'price',
        'image',
        'medium',
    ];
}

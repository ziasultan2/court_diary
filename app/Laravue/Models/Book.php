<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name', 'path'
    ];
}

<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class EService extends Model
{
    protected $fillable = [
        'photo',
        'name',
        'external_link'
    ];
}

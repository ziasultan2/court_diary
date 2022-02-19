<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class EService extends Model
{
    protected $fillable = [
        'name',
        'external_link'
    ];
}

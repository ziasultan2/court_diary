<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'mobile',
        'title',
        'email',
        'address',
    ];
}

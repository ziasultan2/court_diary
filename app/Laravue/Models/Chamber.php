<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class Chamber extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'joining_date',
        'cv',
        'mobile',
        'salary',
        'type',
        'comments',
        'working_days',
    ];
}

<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    protected $fillable = [
        'mobile',
        'title',
        'bar_name',
        'membership_no',
        'expertise',
        'email',
        'address',
    ];
}

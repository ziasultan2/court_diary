<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class CourtCase extends Model
{
    protected $table = ['cases'];
    protected $fillable = [
        'court_id',
        'client_id',
        'case_type',
        'case_number',
        'case_year',
        'petitioner',
        'respondent',
        'case_date_entry',
        'file_no',
        'payment',
        'dues',
        'comments'
    ];
}

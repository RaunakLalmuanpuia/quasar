<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'employee_file',
        'employer_file',
        'manager_file',
        'employer_status',
        'manager_status',
        'movement',
        'employer_feedback',
        'manager_feedback',
        'employee_id',
        'employer_id',
        'manager_id'

    ];
}

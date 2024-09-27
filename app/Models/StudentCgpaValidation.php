<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCgpaValidation extends Model
{
    use HasFactory;
    protected $table = 'student_cgpa_validation';
    protected $fillable = [
        's_id',
        'level',
        'semester',
        'cgpa',
        'done',
    ];
}

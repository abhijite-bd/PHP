<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'exam';

    // Define the fillable properties
    protected $fillable = [
        'course_code',
        'course_name',
        'teacher',
        'type',
        'date',
        'time',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_Schedule extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'courses_schedule';

    // Define the fillable attributes
    protected $fillable = [
        'course_code',
        'date',
        'day',
        'time',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cgpa extends Model
{
    use HasFactory;
    protected $table = 'cgpas';
    protected $fillable = [
        's_id', 'sem1', 'sem2', 'sem3', 'sem4', 'sem5', 'sem6', 'sem7', 'sem8', 'valid'
    ];
}

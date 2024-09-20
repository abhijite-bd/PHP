<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cgpa extends Model
{
    use HasFactory;
    protected $table = 'cgpa';
    protected $guarded = ['created_at', 'updated_at'];
}

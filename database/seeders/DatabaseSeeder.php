<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Admin;
use App\Models\Faculty;
use App\Models\Department;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $teacher = Teacher::create([
            'name' => 'Teacher 1',
            'role' => 'Teacher',
            'department' => '1',
            'faculty' => '1',
            'designation' => 'Professor',
            'email' => 't1@example.com',
            'password' => Hash::make('password'),
        ]);
        
        
        $student = Student::create([
            's_id' => '1702020',
            'name' => 'Student 1',
            'role' => 'Student',
            'level' => '1',
            'semester' => 'i',
            'session' => '2017',
            'degree' => 'B.Sc. in CSE',
            'email' => 't1@example.com',
            'password' => Hash::make('password'),
        ]);

        $admin = Admin::create([
            'name' => 'Admin',
            'role' => 'Admin',
            'email' => 't1@example.com',
            'password' => Hash::make('password'),
        ]);

        $faculty = Faculty::create([
            'name' => 'Computer Science and Engineering',
        ]);

        $faculty = Faculty::create([
            'name' => 'Agriculture',
        ]);

        $department = Department::create([
            'name' => 'Computer Science and Engineering',
            'code' => 'CSE',
            'faculty' => '1',
        ]);

        $department = Department::create([
            'name' => 'Electronics and Communication Engineering',
            'code' => 'ECE',
            'faculty' => '1',
        ]);

        $department = Department::create([
            'name' => 'Electronics and Electrical Engineering',
            'code' => 'EEE',
            'faculty' => '1',
        ]);

        $department = Department::create([
            'name' => 'Agronomy',
            'code' => 'AGR',
            'faculty' => '2',
        ]);

        $department = Department::create([
            'name' => 'Horticulture',
            'code' => 'HRT',
            'faculty' => '2',
        ]);
    }
}

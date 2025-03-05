<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $courses = ['IT', 'NURSING', 'ACCOUNTANCY', 'BUSINESS AD', 'EDUC'];
        $yearLevels = ['1st', '2nd', '3rd', '4th', '5th', '6th'];
        $genders = ['Male', 'Female'];
        $addresses = [
            'Malaybalay City, Bukidnon',
            'Valencia City, Bukidnon',
            'Manolo Fortich, Bukidnon',
            'Quezon, Bukidnon',
            'Don Carlos, Bukidnon',
            'Maramag, Bukidnon',
            'San Fernando, Bukidnon',
            'Kibawe, Bukidnon'
        ];

        for ($i = 1; $i <= 50; $i++) {
            $firstName = fake()->firstName();
            $lastName = fake()->lastName();
            $name = $firstName . ' ' . $lastName;
            $course = $courses[array_rand($courses)];
            $yearLevel = $yearLevels[array_rand($yearLevels)];
            
            // Ensure more students in years 1-4, fewer in 5-6
            if ($yearLevel === '5th' || $yearLevel === '6th') {
                if (rand(1, 100) > 15) { // 85% chance to reassign to years 1-4
                    $yearLevel = $yearLevels[rand(0, 3)];
                }
            }

            // Create User with all required fields
            $user = User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@student.buksu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'added_as_student',
                'address' => $addresses[array_rand($addresses)],
                'age' => rand(17, 25),
                'phone' => '09' . rand(100000000, 999999999),
                'gender' => $genders[array_rand($genders)],
                'year_level' => intval($yearLevel),
                'course' => $course
            ]);

            // Generate student ID (YYYY-COURSE-XXXXX)
            $year = date('Y');
            $studentNumber = str_pad($i, 5, '0', STR_PAD_LEFT);
            $studentId = $year . '-' . str_replace(' ', '', $course) . '-' . $studentNumber;

            // Create Student
            Student::create([
                'student_id' => $studentId,
                'name' => $name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'age' => $user->age,
                'year_level' => $yearLevel,
                'course' => $course,
                'gender' => $user->gender
            ]);
        }
    }
} 
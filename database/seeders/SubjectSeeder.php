<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            // IT Subjects
            [
                'code' => 'IT101',
                'name' => 'Introduction to Computing',
                'units' => 3
            ],
            [
                'code' => 'IT102',
                'name' => 'Computer Programming 1',
                'units' => 3
            ],
            [
                'code' => 'IT103',
                'name' => 'Computer Programming 2',
                'units' => 3
            ],
            [
                'code' => 'IT104',
                'name' => 'Data Structures and Algorithms',
                'units' => 3
            ],
            [
                'code' => 'IT105',
                'name' => 'Database Management Systems',
                'units' => 3
            ],
            
            // NURSING Subjects
            [
                'code' => 'NUR101',
                'name' => 'Fundamentals of Nursing',
                'units' => 5
            ],
            [
                'code' => 'NUR102',
                'name' => 'Health Assessment',
                'units' => 4
            ],
            [
                'code' => 'NUR103',
                'name' => 'Medical-Surgical Nursing',
                'units' => 5
            ],
            
            // EDUCATION Subjects
            [
                'code' => 'EDUC101',
                'name' => 'Foundation of Education',
                'units' => 3
            ],
            [
                'code' => 'EDUC102',
                'name' => 'Child and Adolescent Development',
                'units' => 3
            ],
            [
                'code' => 'EDUC103',
                'name' => 'Principles of Teaching',
                'units' => 3
            ],
            
            // BUSINESS AD Subjects
            [
                'code' => 'BA101',
                'name' => 'Principles of Management',
                'units' => 3
            ],
            [
                'code' => 'BA102',
                'name' => 'Business Economics',
                'units' => 3
            ],
            [
                'code' => 'BA103',
                'name' => 'Marketing Management',
                'units' => 3
            ],
            
            // ACCOUNTANCY Subjects
            [
                'code' => 'ACC101',
                'name' => 'Financial Accounting',
                'units' => 3
            ],
            [
                'code' => 'ACC102',
                'name' => 'Cost Accounting',
                'units' => 3
            ],
            [
                'code' => 'ACC103',
                'name' => 'Auditing Principles',
                'units' => 3
            ],
            
            // General Education Subjects
            [
                'code' => 'GE101',
                'name' => 'Understanding the Self',
                'units' => 3
            ],
            [
                'code' => 'GE102',
                'name' => 'Mathematics in the Modern World',
                'units' => 3
            ],
            [
                'code' => 'GE103',
                'name' => 'Science, Technology and Society',
                'units' => 3
            ]
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
} 
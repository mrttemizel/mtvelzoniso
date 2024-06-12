<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Economics',
            ],
            [
                'name' => 'Business Administration',
            ],
            [
                'name' => 'Political Science and International Relations',
            ],
            [
                'name' => 'Psychology',
            ],
            [
                'name' => 'Computer Engineering',
            ],
            [
                'name' => 'Electrical and Electronics Engineering',
            ],
            [
                'name' => 'Industrial Engineering',
            ],
            [
                'name' => 'Civil Engineering',
            ],
            [
                'name' => 'Mechanical Engineering',
            ],
            [
                'name' => 'Law',
            ],
            [
                'name' => 'Tourism and Hotel Managenment',
            ],
            [
                'name' => 'Gastronomy And Culinary Arts',
            ],
            [
                'name' => 'Architecture',
            ],
            [
                'name' => 'Interior Architecture and Environmental Design',
            ],
            [
                'name' => 'Pilotage(Turkish)',
            ],
            [
                'name' => 'Midwifery',
            ],
            [
                'name' => 'Nutrition ad Dictetics',
            ],
            [
                'name' => 'Nursing',
            ],
            [
                'name' => 'Physiotherapy and Rehabilition',
            ],
            [
                'name' => 'Dentistry',
            ],
        ];

        foreach ($departments as $department) {
            if (Department::query()->where('name', '=', $department['name'])->exists()) {
                continue;
            }

            Department::query()->create($department);
        }
    }
}

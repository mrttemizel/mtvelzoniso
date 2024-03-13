<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [   'id' => 1,
                'section_name' => 'Economics',
            ],
            [   'id' => 2,
                'section_name' => 'Business Administration',
            ],
            [   'id' => 3,
                'section_name' => 'Political Science and International Relations',
            ],
            [   'id' => 4,
                'section_name' => 'Psychology',
            ],
            [   'id' => 5,
                'section_name' => 'Computer Engineering',
            ],
            [   'id' => 6,
                'section_name' => 'Electrical and Electronics Engineering',
            ],
            [   'id' => 7,
                'section_name' => 'Industrial Engineering',
            ],
            [   'id' => 8,
                'section_name' => 'Civil Engineering',
            ],
            [   'id' => 9,
                'section_name' => 'Mechanical Engineering',
            ],
            [   'id' => 10,
                'section_name' => 'Law',
            ],
            [   'id' => 11,
                'section_name' => 'Tourism and Hotel Managenment',
            ],
            [   'id' => 12,
                'section_name' => 'Gastronomy And Culinary Arts',
            ],
            [   'id' => 13,
                'section_name' => 'Architecture',
            ],
            [   'id' => 14,
                'section_name' => 'Interior Architecture and Environmental Design',
            ],
            [   'id' => 15,
                'section_name' => 'Pilotage(Turkish)',
            ],
            [   'id' => 16,
                'section_name' => 'Midwifery',
            ],
            [   'id' => 17,
                'section_name' => 'Nutrition ad Dictetics',
            ],
            [   'id' => 18,
                'section_name' => 'Nursing',
            ],

            [   'id' => 19,
                'section_name' => 'Physiotherapy and Rehabilition',
            ],
            [   'id' => 20,
                'section_name' => 'Dentistry',
            ],
        ];

        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}

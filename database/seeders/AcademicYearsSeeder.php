<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicYearsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentYear = now();
        $nextYear = now()->addYear();

        for ($y = 0; $y <= 50; $y++) {
            AcademicYear::query()->create([
                'name' => $currentYear->format('Y') . ' - ' . $nextYear->format('Y')
            ]);

            $currentYear->addYear();
            $nextYear->addYear();
        }
    }
}

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
        $departments = array(
            "FACULTY OF DENTISTRY" => array(
                "Dentistry (Turkish)" => 11900
            ),
            "FACULTY OF ENGINEERING AND NATURAL SCIENCES" => array(
                "Computer Engineering (English)" => 3320,
                "Electrical and Electronics Engineering (English)" => 3320,
                "Industrial Engineering (English)" => 3320,
                "Mechanical Engineering (English)" => 3320,
                "Civil Engineering (English)" => 3320
            ),
            "FACULTY OF FINE ARTS AND ARCHITECTURE" => array(
                "Architecture (English)" => 3320,
                "Interior Architecture and Environmental Design (English)" => 3320
            ),
            "FACULTY OF TOURISM" => array(
                "Tourism Management (English)" => 2905,
                "Gastronomy and Culinary Arts (English)" => 2905
            ),
            "FACULTY OF BUSINESS AND SOCIAL SCIENCES" => array(
                "Economics (English)" => 2905,
                "Business Administration (English)" => 2905,
                "Political Science and International Relations (English)" => 2905,
                "Psychology (English)" => 3320
            ),
            "FACULTY OF LAW" => array(
                "Law School" => 3320
            ),
            "FACULTY OF HEALTH SCIENCES" => array(
                "Nursing (Turkish)" => 2905,
                "Physiotherapy and Rehabilitation (Turkish)" => 2905,
                "Midwifery (Turkish)" => 2905,
                "Nutrition and Dietetics (Turkish)" => 2905
            ),
            "SCHOOL OF CIVIL AVIATION" => array(
                "Pilotage (Turkish)" => 7055
            ),
            "VOCATIONAL SCHOOL" => array(
                "Flight Dispatch Management (Turkish)" => 2080,
                "Cookery (Turkish)" => 2080,
                "Computer Programming (Turkish)" => 2080,
                "Construction Technology (Turkish)" => 2080
            ),
            "VOCATIONAL SCHOOL OF HEALTH SERVICES" => array(
                "First and Emergency Aid (Turkish)" => 2080,
                "Medical Laboratory Techniques (Turkish)" => 2080,
                "Medical Imaging Techniques (Turkish)" => 2080,
                "Physiotherapy (Turkish)" => 2080,
                "Oral and Dental Health (Turkish)" => 2080,
                "Anesthesia (Turkish)" => 2080,
                "Surgery Services (Turkish)" => 2080,
                "Dialysis (Turkish)" => 2080,
                "Opticianry (Turkish)" => 2080
            ),
            "VOCATIONAL SCHOOL OF JUSTICE" => array(
                "Justice (Turkish)" => 2080
            ),
            "MASTER PROGRAMS (ENGLISH)" => array(
                "Master of Business Administration (Thesis- English)" => 4590,
                "Master of Business Administration (Non- Thesis- English)" => 3400,
                "Master of Global Politics and International Relations (Thesis- English)" => 4590,
                "Master of Electrical and Computer Engineering (Thesis- English)" => 4590,
                "Master of Civil Engineering (Thesis- English)" => 4590,
                "Master of Cyber Security (Thesis- English)" => 4590,
                "Master of Data Science (Non- Thesis- English)" => 3400
            ),
            "MASTER PROGRAMS (TURKISH)" => array(
                "Master of Business Administration (Thesis- Turkish)" => 4590,
                "Master of Business Administration (Non- Thesis- Turkish)" => 3400,
                "Master of Civil Engineering (Thesis- Turkish)" => 4590,
                "Master of Civil Engineering (Non- Thesis- Turkish)" => 3400,
                "Master of Cyber Security (Thesis- Turkish)" => 4590,
                "Master of Public Law (Thesis- Turkish)" => 4590,
                "Master of Public Law (Non- Thesis- Turkish)" => 3400,
                "Master of Private Law (Thesis- Turkish)" => 4590,
                "Master of Private Law (Non- Thesis- Turkish)" => 3400,
                "Master of Architecture (Thesis- Turkish)" => 4590,
                "Physiotherapy and Rehabilitation (Thesis- Turkish)" => 4590,
                "Master of Clinical Psychology (Thesis- Turkish)" => 8000,
                "Master of Global Politics and International Relations (Non- Thesis- Turkish)" => 3400,
                "Master of Occupational Health and Safety (Non- Thesis- Turkish)" => 3400
            ),
            "" => array(
                'Ph.D. in Business Administration (Turkish)' => 7650
            )
        );

        foreach ($departments as $department => $programs) {

            foreach ($programs as $name => $price) {
                $faculty = ucwords(strtolower($department));
                $programName = ucwords(strtolower($name));


                $exist = Department::query()
                    ->where('faculty', '=', $faculty)
                    ->where('name', '=', $programName)
                    ->exists();

                if ($exist) {
                    continue;
                }

                Department::query()->create([
                    'faculty' => $faculty,
                    'name' => $programName,
                    'annual_fee' => $price
                ]);
            }
        }
    }
}

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
                "Dentistry (Turkish)" => array("price" => 14000, "discounted_price" => 14000)
            ),
            "FACULTY OF ENGINEERING AND NATURAL SCIENCES" => array(
                "Computer Engineering (English)" => array("price" => 8300, "discounted_price" => 3735),
                "Electrical and Electronics Engineering (English)" => array("price" => 8300, "discounted_price" => 3735),
                "Industrial Engineering (English)" => array("price" => 8300, "discounted_price" => 3735),
                "Mechanical Engineering (English)" => array("price" => 8300, "discounted_price" => 3735),
                "Civil Engineering (English)" => array("price" => 8300, "discounted_price" => 3735)
            ),
            "FACULTY OF FINE ARTS AND ARCHITECTURE" => array(
                "Architecture (English)" => array("price" => 8300, "discounted_price" => 3735),
                "Interior Architecture and Environmental Design (English)" => array("price" => 8300, "discounted_price" => 3735)
            ),
            "FACULTY OF TOURISM" => array(
                "Tourism Management (English)" => array("price" => 8300, "discounted_price" => 3320),
                "Gastronomy and Culinary Arts (English)" => array("price" => 8300, "discounted_price" => 3320)
            ),
            "FACULTY OF BUSINESS AND SOCIAL SCIENCES" => array(
                "Economics (English)" => array("price" => 8300, "discounted_price" => 3320),
                "Business Administration (English)" => array("price" => 8300, "discounted_price" => 3320),
                "Political Science and International Relations (English)" => array("price" => 8300, "discounted_price" => 3320),
                "Psychology (English)" => array("price" => 8300, "discounted_price" => 3735)
            ),
            "FACULTY OF LAW" => array(
                "Law School" => array("price" => 8300, "discounted_price" => 3735)
            ),
            "FACULTY OF HEALTH SCIENCES" => array(
                "Nursing (Turkish)" => array("price" => 8300, "discounted_price" => 3320),
                "Physiotherapy and Rehabilitation (Turkish)" => array("price" => 8300, "discounted_price" => 3320),
                "Midwifery (Turkish)" => array("price" => 8300, "discounted_price" => 3320),
                "Nutrition and Dietetics (Turkish)" => array("price" => 8300, "discounted_price" => 3320)
            ),
            "SCHOOL OF CIVIL AVIATION" => array(
                "Pilotage (Turkish)" => array("price" => 8300, "discounted_price" => 8300)
            ),
            "VOCATIONAL SCHOOL" => array(
                "Cookery (Turkish)" => array("price" => 5200, "discounted_price" => 2340),
                "Computer Programming (Turkish)" => array("price" => 5200, "discounted_price" => 2340),
                "Construction Technology (Turkish)" => array("price" => 5200, "discounted_price" => 2340),
                "Court Office Services (Turkish)" => array("price" => 5200, "discounted_price" => 2340)
            ),
            "VOCATIONAL SCHOOL OF HEALTH SERVICES" => array(
                "First and Emergency Aid (Turkish)" => array("price" => 5200, "discounted_price" => 2340),
                "Medical Laboratory Techniques (Turkish)" => array("price" => 5200, "discounted_price" => 2340),
                "Medical Imaging Techniques (Turkish)" => array("price" => 5200, "discounted_price" => 2340),
                "Physiotherapy (Turkish)" => array("price" => 5200, "discounted_price" => 2340),
                "Oral and Dental Health (Turkish)" => array("price" => 5200, "discounted_price" => 2340),
                "Anesthesia (Turkish)" => array("price" => 5200, "discounted_price" => 2340),
                "Surgery Services (Turkish)" => array("price" => 5200, "discounted_price" => 2340),
                "Dialysis (Turkish)" => array("price" => 5200, "discounted_price" => 2340),
                "Opticianry (Turkish)" => array("price" => 5200, "discounted_price" => 2340)
            ),
            "MASTER PROGRAMS (ENGLISH)" => array(
                "Master of Business Administration (Thesis- English)" => array("price" => 5400, "discounted_price" => 5400),
                "Master of Business Administration (Non- Thesis- English)" => array("price" => 4000, "discounted_price" => 4000),
                "Master of Global Politics and International Relations (Thesis- English)" => array("price" => 5400, "discounted_price" => 5400),
                "Master of Electrical and Computer Engineering (Thesis- English)" => array("price" => 5400, "discounted_price" => 5400),
                "Master of Civil Engineering (Thesis- English)" => array("price" => 5400, "discounted_price" => 5400),
                "Master of Cyber Security (Thesis- English)" => array("price" => 5400, "discounted_price" => 5400),
                "Master of Data Science (Non- Thesis- English)" => array("price" => 4000, "discounted_price" => 4000)
            ),
            "MASTER PROGRAMS (TURKISH)" => array(
                "Master of Business Administration (Thesis- Turkish)" => array("price" => 5400, "discounted_price" => 5400),
                "Master of Business Administration (Non- Thesis- Turkish)" => array("price" => 4000, "discounted_price" => 4000),
                "Master of Civil Engineering (Thesis- Turkish)" => array("price" => 5400, "discounted_price" => 5400),
                "Master of Civil Engineering (Non- Thesis- Turkish)" => array("price" => 4000, "discounted_price" => 4000),
                "Master of Cyber Security (Thesis- Turkish)" => array("price" => 5400, "discounted_price" => 5400),
                "Master of Public Law (Thesis- Turkish)" => array("price" => 5400, "discounted_price" => 5400),
                "Master of Public Law (Non- Thesis- Turkish)" => array("price" => 4000, "discounted_price" => 4000),
                "Master of Private Law (Thesis- Turkish)" => array("price" => 5400, "discounted_price" => 5400),
                "Master of Private Law (Non- Thesis- Turkish)" => array("price" => 4000, "discounted_price" => 4000),
                "Master of Architecture (Thesis- Turkish)" => array("price" => 5400, "discounted_price" => 5400),
                "Physiotherapy and Rehabilitation (Thesis- Turkish)" => array("price" => 5400, "discounted_price" => 5400),
                "Master of Clinical Psychology (Thesis- Turkish)" => array("price" => 15000, "discounted_price" => 15000),
                "Master of Global Politics and International Relations (Non- Thesis- Turkish)" => array("price" => 4000, "discounted_price" => 4000),
                "Master of Occupational Health and Safety (Non- Thesis- Turkish)" => array("price" => 4000, "discounted_price" => 4000)
            ),
            "" => [
                "Ph.D. in Business Administration (Turkish)" => array("price" => 9000, "discounted_price" => 9000)
            ]
        );


        foreach ($departments as $department => $programs) {
            foreach ($programs as $name => $prices) {
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
                    'annual_fee' => $prices['price'] ?? 0,
                    'discounted_fee' => $prices['discounted_price'] ?? 0
                ]);
            }
        }
    }
}

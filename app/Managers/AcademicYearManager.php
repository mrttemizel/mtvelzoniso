<?php

namespace App\Managers;

use App\Models\AcademicYear;

class AcademicYearManager
{
    public function findById($id)
    {
        return AcademicYear::query()->find($id);
    }

    /**
     * @throws \Exception
     */
    public function create(array $data)
    {
        return AcademicYear::query()->create($data);
    }

    public function update(AcademicYear $agency, array $data)
    {
        $agency->update($data);

        return $agency;
    }

    public function delete(AcademicYear $agency): void
    {
        $agency->delete();
    }
}

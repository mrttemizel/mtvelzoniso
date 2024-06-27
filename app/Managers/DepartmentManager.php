<?php

namespace App\Managers;

use App\Models\Department;

class DepartmentManager
{
    public function create(array $data): Department
    {
        /** @var Department $item */
        $item = Department::query()->create($data);

        return $item;
    }

    public function update(Department $department, array $data): void
    {
        $department->update($data);
    }

    public function delete(Department $department): void
    {
        $department->delete();
    }
}

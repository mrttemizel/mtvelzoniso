<?php

use Illuminate\Database\Eloquent\Collection;

if (! function_exists('countries')) {
    function countries(): Collection
    {
        return \App\Models\Country::query()->get();
    }
}

if (! function_exists('departments')) {
    function departments(bool $all = false): Collection
    {
        $query = \App\Models\Department::query();

        if ($all === false) {
            $query->where('status', '=', \App\Enums\DepartmentStatusEnum::ACTIVE->value);
        }

        $query->orderBy('name', 'ASC');

        return $query->get();
    }
}

if (! function_exists('agencies')) {
    function agencies(): Collection
    {
        return \App\Models\Agency::query()->get();
    }
}

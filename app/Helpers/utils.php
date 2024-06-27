<?php

use Illuminate\Database\Eloquent\Collection;

if (! function_exists('countries')) {
    function countries(): Collection
    {
        return \App\Models\Country::query()->get();
    }
}

if (! function_exists('departments')) {
    function departments(): Collection
    {
        return \App\Models\Department::query()->get();
    }
}

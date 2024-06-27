<?php

namespace App\Managers;

use Illuminate\Support\Facades\Storage;

class BaseManager
{
    protected string $diskName = 'public';

    public function disk(string|null $diskName = null)
    {
        if (is_null($diskName)) {
            $diskName = $this->diskName;
        }

        return Storage::disk($diskName);
    }
}

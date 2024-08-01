<?php

namespace App\Exports;

use App\Models\Application;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ApplicationsExport implements FromQuery, WithMapping
{
    use Exportable;

    public $status = null;

    public $nationality = null;

    public $agency = null;

    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }

    public function setNationality($nationality): self
    {
        $this->nationality = $nationality;
        return $this;
    }

    public function setAgency($agency): self
    {
        $this->agency = $agency;
        return $this;
    }

    public function query()
    {
        $query = Application::query()->with(['nationality', 'department']);

        if (! is_null($this->status)) {
            $query->where('status', '=', $this->status);
        }

        if (! is_null($this->nationality)) {
            $query->where('nationality_id', '=', $this->nationality);
        }

        if (! is_null($this->agency)) {
            $query->where('agency_id', '=', $this->agency);
        }

        return $query;
    }

    public function map($application): array
    {
        return [
            $application->code ?? '',
            $application->name ?? '',
            $application->nationality->name ?? '',
            $application->department->faculty ?? '',
            $application->department->name ?? '',
            $application->agency->name ?? ''
        ];
    }
}

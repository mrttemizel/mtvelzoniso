<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApplicationsExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    public $status = null;

    public $agency = null;

    public function setStatus($status): self
    {
        $this->status = $status;
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

        if (! is_null($this->agency)) {
            $query->where('agency_id', '=', $this->agency);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            trans('application.excel.code'),
            trans('application.excel.name'),
            trans('application.excel.faculty'),
            trans('application.excel.department'),
            trans('application.excel.agencyName'),
        ];
    }

    public function map($application): array
    {
        return [
            $application->code ?? '',
            $application->name ?? '',
            $application->department->faculty ?? '',
            $application->department->name ?? '',
            $application->agency->name ?? ''
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A1:F1' => [
                'font' => [
                    'bold' => true,
                    'color' => [
                        'rgb' => 'd73939'
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ]
        ];
    }
}

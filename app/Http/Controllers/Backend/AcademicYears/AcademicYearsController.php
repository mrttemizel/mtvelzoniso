<?php

namespace App\Http\Controllers\Backend\AcademicYears;

use App\Enums\AcademicYearStatusEnum;
use App\Http\Controllers\Controller;
use App\Managers\AcademicYearManager;
use App\Models\AcademicYear;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;

class AcademicYearsController extends Controller
{
    public function __construct(
        public readonly AcademicYearManager $academicYearManager
    ) { }

    public function index(): View
    {
        return view('backend.academicYears.index');
    }

    public function create(): View
    {
        return view('backend.academicYears.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:1', 'max:255']
        ]);

        return DB::transaction(function () use ($request) {
            try {
                $this->academicYearManager->create([
                    'name' => $request->input('name')
                ]);

                return redirect()
                    ->route('backend.academic-years.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('academicYear.success.created'))
                ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.academic-years.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                ;
            }
        });
    }

    public function edit(AcademicYear $academicYear)
    {
        return view('backend.academicYears.edit')
            ->with('academicYear', $academicYear)
        ;
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $request->validate([
            'name' => ['required', 'min:1', 'max:255']
        ]);

        return DB::transaction(function () use ($request, $academicYear) {
            try {
                $this->academicYearManager->update($academicYear, [
                    'name' => $request->input('name')
                ]);

                return redirect()
                    ->route('backend.academic-years.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('academicYear.success.updated'))
                    ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.academic-years.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                    ;
            }
        });
    }

    public function suspend(Request $request)
    {
        $request->validate([
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'status' => ['required', new Enum(AcademicYearStatusEnum::class)]
        ]);

        return DB::transaction(function () use ($request) {
            try {
                /** @var AcademicYear $academicYear */
                $academicYear = $this->academicYearManager->findById($request->input('academic_year_id'));
                $status = $request->input('status') == AcademicYearStatusEnum::ACTIVE->value ? AcademicYearStatusEnum::ACTIVE->value : AcademicYearStatusEnum::INACTIVE->value;

                $this->academicYearManager->update($academicYear, [
                    'status' => $status
                ]);

                return redirect()
                    ->route('backend.academic-years.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('academicYear.success.suspended'))
                ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.agencies.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                    ;
            }
        });
    }

    public function dataTable(): JsonResponse
    {
        $model = AcademicYear::query();

        return datatables()
            ->eloquent($model)
            ->editColumn('status', function ($item) {
                if ($item->status === AcademicYearStatusEnum::ACTIVE->value) {
                    return '<span class="badge bg-success">' . trans('academicYear.statuses.active') . '</span>';
                }

                return '<span class="badge bg-warning">' . trans('academicYear.statuses.inactive') . '</span>';
            })
            ->addColumn('actions', function ($item) {
                return view('backend._partials.datatables._academicYears-actions')
                    ->with('item', $item)
                    ->with('editRoute', route('backend.academic-years.edit', ['academicYearId' => $item->id]))
                ;
            })
            ->rawColumns(['status'])
            ->toJson();
    }
}

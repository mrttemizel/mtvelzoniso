<?php

namespace App\Http\Controllers\Backend\Departments;

use App\Http\Controllers\Controller;
use App\Managers\DepartmentManager;
use App\Models\Department;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function __construct(
        private readonly DepartmentManager $departmentManager
    ) { }

    public function index(): View
    {
        return view('backend.departments.index');
    }

    public function create(): View
    {
        return view('backend.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'annual_fee' => ['required', 'numeric', 'between:1,9999999999.99'],
            'discounted_fee' => ['nullable', 'numeric', 'between:1,9999999999.99'],
        ]);

        return DB::transaction(function () use ($request) {
            try {
                $this->departmentManager->create([
                    'name' => $request->input('name'),
                    'annual_fee' => $request->input('annual_fee'),
                    'discounted_fee' => $request->input('discounted_fee'),
                ]);

                return redirect()
                    ->route('backend.departments.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('department.success.created'))
                ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.departments.create')
                    ->withInput()
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                ;
            }
        });
    }

    public function edit(Department $department): View
    {
        return view('backend.departments.edit')
            ->with('department', $department)
        ;
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'annual_fee' => ['required', 'numeric', 'between:1,9999999999.99'],
            'discounted_fee' => ['nullable', 'numeric', 'between:1,9999999999.99']
        ]);

        return DB::transaction(function () use ($request, $department) {
            try {
                $this->departmentManager->update($department, [
                    'name' => $request->input('name'),
                    'annual_fee' => $request->input('annual_fee'),
                    'discounted_fee' => $request->input('discounted_fee'),
                ]);

                return redirect()
                    ->route('backend.departments.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('department.success.updated'))
                    ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.departments.edit', ['departmentId' => $department->id])
                    ->withInput()
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                    ;
            }
        });
    }

    public function destroy(Department $department)
    {
        return DB::transaction(function () use ($department) {
            try {
                $this->departmentManager->delete($department);

                return redirect()
                    ->route('backend.departments.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('department.success.deleted'))
                    ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.departments.edit', ['departmentId' => $department->id])
                    ->withInput()
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                    ;
            }
        });
    }

    public function dataTable(): JsonResponse
    {
        $model = Department::query()
            ->orderBy('id', 'DESC')
        ;

        return datatables()
            ->eloquent($model)
            ->addColumn('actions', function ($item) {
                return view('backend._partials.datatables._default-actions')
                    ->with('editRoute', route('backend.departments.edit', ['departmentId' => $item->id]))
                    ->with('deleteRoute', route('backend.departments.destroy', ['departmentId' => $item->id]))
                ;
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}

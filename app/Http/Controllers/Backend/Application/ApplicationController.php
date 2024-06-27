<?php

namespace App\Http\Controllers\Backend\Application;

use App\Enums\ApplicationStatusEnum;
use App\Enums\ApplicationStepEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\ApplicationStoreRequest;
use App\Http\Requests\Applications\ApplicationUpdateRequest;
use App\Http\Requests\Applications\ApplicationUpdateStatusRequest;
use App\Managers\ApplicationManager;
use App\Models\Application;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ApplicationController extends Controller
{
    public function __construct(
        private readonly ApplicationManager $applicationManager
    ) { }

    public function index(): View
    {
        return view('backend.applications.index');
    }

    public function create(): View
    {
        return view('backend.applications.create');
    }

    public function store(ApplicationStoreRequest $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                /** @var Application $application */
                $application = $this->applicationManager->create([
                    'department_id' => $request->get('department_id'),
                    'country_id' => $request->input('country_id'),
                    'name' => $request->input('name'),
                    'nationality_id' => $request->input('nationality_id'),
                    'passport_number' => $request->input('passport_number'),
                    'place_of_birth' => $request->input('place_of_birth'),
                    'date_of_birth' => $request->input('date_of_birth'),
                    'address' => $request->input('address'),
                    'phone_number' => $request->input('phone_number'),
                    'email' => $request->input('email'),
                    'school_name' => $request->input('school_name'),
                    'school_country_id' => $request->input('school_country_id'),
                    'school_city' => $request->input('school_city'),
                    'year_of_graduation' => $request->input('year_of_graduation'),
                    'graduation_degree' => $request->input('graduation_degree'),
                    'reference' => $request->input('reference'),
                ]);

                if ($request->hasFile('passport_photo')) {
                    $this->applicationManager->uploadPassportPhoto($application, $request->file('passport_photo'));
                }

                if ($request->hasFile('official_transcript')) {
                    $this->applicationManager->uploadTranscript($application, $request->file('official_transcript'));
                }

                if ($request->hasFile('document_file')) {
                    $this->applicationManager->uploadDocumentFile($application, $request->file('document_file'));
                }

                return redirect()
                    ->route('backend.applications.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('application.success.created'))
                ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.applications.create')
                    ->withInput()
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                ;
            }
        });
    }

    public function updateStatus(ApplicationUpdateStatusRequest $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                /** @var Application $application */
                $application = Application::query()
                    ->where('id', '=', $request->input('id'))
                    ->first();

                $this->applicationManager->updateStatus($application, $request->input('status'));

                return redirect()
                    ->route('backend.applications.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('application.success.status-updated'))
                    ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.applications.index')
                    ->withInput()
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                ;
            }
        });
    }

    public function edit(Application $application): View
    {
        /** @var User $user */
        $user = auth()->user();

        if (! $user->isAllAdmin()) {
            // acente kendi basvurusu degilse hata verecek
            if ($user->isAgency() && $user->agency_id != $application->agency_id) {
                abort(Response::HTTP_FORBIDDEN);
            }

            if ($user->id != $application->user_id) {
                abort(Response::HTTP_FORBIDDEN);
            }
        }

        return view('backend.applications.edit')
            ->with('application', $application)
        ;
    }

    public function update(ApplicationUpdateRequest $request, Application $application)
    {
        return DB::transaction(function () use ($request, $application) {
            try {
                $this->applicationManager->update($application, [
                    'department_id' => $request->get('department_id'),
                    'country_id' => $request->input('country_id'),
                    'name' => $request->input('name'),
                    'nationality_id' => $request->input('nationality_id'),
                    'passport_number' => $request->input('passport_number'),
                    'place_of_birth' => $request->input('place_of_birth'),
                    'date_of_birth' => $request->input('date_of_birth'),
                    'address' => $request->input('address'),
                    'phone_number' => $request->input('phone_number'),
                    'email' => $request->input('email'),
                    'school_name' => $request->input('school_name'),
                    'school_country_id' => $request->input('school_country_id'),
                    'school_city' => $request->input('school_city'),
                    'year_of_graduation' => $request->input('year_of_graduation'),
                    'graduation_degree' => $request->input('graduation_degree'),
                    'reference' => $request->input('reference'),
                ]);

                if ($request->hasFile('passport_photo')) {
                    $this->applicationManager->uploadPassportPhoto($application, $request->file('passport_photo'));
                }

                if ($request->hasFile('official_transcript')) {
                    $this->applicationManager->uploadTranscript($application, $request->file('official_transcript'));
                }

                if ($request->hasFile('document_file')) {
                    $this->applicationManager->uploadDocumentFile($application, $request->file('document_file'));
                }

                // odeme alindiginda basvuru durumunu guncelleyecegiz
                if ($request->hasFile('payment_file')) {
                    $this->applicationManager->uploadPaymentFile($application, $request->file('payment_file'));
                }

                return redirect()
                    ->route('backend.applications.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('application.success.created'))
                ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.applications.create')
                    ->withInput()
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                ;
            }
        });
    }

    public function getColumns(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $columns = [
            [ 'data' => 'id', 'name' => 'id' ],
            [ 'data' => 'name', 'name' => 'name' ],
            [ 'data' => 'nationality.name', 'name' => 'nationality.name' ],
            [ 'data' => 'status', 'name' => 'status', 'searchable' => false, 'orderable' => false ],
            [ 'data' => 'actions', 'name' => 'actions', 'searchable' => false, 'orderable' => false ],
        ];

        if ($user->isAllAdmin()) {
            $columns = [
                [ 'data' => 'id', 'name' => 'applications.id' ],
                [ 'data' => 'agency_name', 'name' => 'agency_name', 'orderable' => false, 'searchable' => false ],
                [ 'data' => 'name', 'name' => 'name' ],
                [ 'data' => 'nationality.name', 'name' => 'nationality.id' ],
                [ 'data' => 'status', 'name' => 'status', 'searchable' => false, 'orderable' => false ],
                [ 'data' => 'actions', 'name' => 'actions', 'searchable' => false, 'orderable' => false ],
            ];
        }

        return response()->json([
            'data' => $columns
        ]);
    }

    public function dataTable(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $relations = ['nationality'];

        $model = Application::query();

        if ($user->isAllAdmin()) {
            $relations[] = 'agency';
        }

        if ($user->isAgency()) {
            $model->where('agency_id', '=', $user->agency_id);
        }

        if ($user->isStudent()) {
            $model->where('user_id', '=', $user->id);
        }

        $model
            ->with($relations)
            ->orderByDesc('applications.id')
        ;


        return datatables()
            ->eloquent($model)
            ->editColumn('agency_name', function ($item) {
                if (is_null($item->agency)) {
                    return trans('application.texts.self-application');
                }

                return $item->agency->name . ' (' . $item->agency->code . ')';
            })
            ->editColumn('status', function ($item) {
                switch ($item->status) {
                    case ApplicationStatusEnum::PENDING->value:
                        return '<span class="badge bg-info">' . trans('application.statuses.pending') . '</span>';
                    break;

                    case ApplicationStatusEnum::APPROVED->value:
                        return '<span class="badge bg-success">' . trans('application.statuses.approved') . '</span>';
                    break;

                    case ApplicationStatusEnum::MISSING_DOCUMENT->value:
                        return '<span class="badge bg-warning">' . trans('application.statuses.missing-document') . '</span>';
                    break;

                    case ApplicationStatusEnum::REJECTED->value:
                        return '<span class="badge bg-danger">' . trans('application.statuses.rejected') . '</span>';
                    break;

                    case ApplicationStatusEnum::PENDING_RECOGNITION_CERTIFICATE->value:
                        return '<span class="badge bg-warning">' . trans('application.statuses.recognition-certificate') . '</span>';
                    break;

                    case ApplicationStatusEnum::PENDING_PAYMENT->value:
                        return '<span class="badge bg-warning">' . trans('application.statuses.pending-payment') . '</span>';
                    break;

                    case ApplicationStatusEnum::OFFICIAL_LETTER_SENT->value:
                        return '<span class="badge bg-primary">' . trans('application.statuses.official-letter') . '</span>';
                    break;

                    default:
                        return '';
                }
            })
            ->addColumn('actions', function ($item) {
                /** @var User $user */
                $user = auth()->user();

                if ($user->isAllAdmin()) {
                    $viewName = 'backend._partials.datatables.applications.' . ApplicationStatusEnum::getStep($item->status);
                    if (view()->exists($viewName)) {
                        return view($viewName)
                            ->with('application', $item)
                        ;
                    }
                }

                if ($user->isAgency()) {
                    return view('backend._partials.datatables.applications.agency')
                        ->with('application', $item)
                    ;
                }

                return '';
            })
            ->rawColumns(['step', 'status', 'actions'])
            ->toJson();
    }
}

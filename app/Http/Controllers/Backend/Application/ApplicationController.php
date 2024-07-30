<?php

namespace App\Http\Controllers\Backend\Application;

use App\Enums\ApplicationStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Applications\ApplicationStoreRequest;
use App\Http\Requests\Applications\ApplicationUpdateRequest;
use App\Http\Requests\Applications\ApplicationUpdateStatusRequest;
use App\Mail\NewStudentRegisteredMail;
use App\Mail\PreApprovalLetterMail;
use App\Mail\SendOfficialLetterMail;
use App\Mail\UpdateApplicationStatusMail;
use App\Mail\UploadedFinancialFileMail;
use App\Managers\ApplicationManager;
use App\Models\Application;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use ZipArchive;

class ApplicationController extends Controller
{
    public function __construct(
        private readonly ApplicationManager $applicationManager
    ) { }

    public function index(): View
    {
        return view('backend.applications.index');
    }

    public function statistics(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $pendingApplicationQuery = Application::query();
        $sentPreLetterQuery = Application::query();
        $pendingPaymentQuery = Application::query();
        $sentOfficialLetterQuery = Application::query();
        $missingDocumentQuery = Application::query();

        if (! is_null($request->input('nationality_id'))) {
            $pendingApplicationQuery
                ->where('nationality_id', '=', $request->input('nationality_id'))
            ;

            $sentPreLetterQuery
                ->where('nationality_id', '=', $request->input('nationality_id'))
            ;

            $pendingPaymentQuery
                ->where('nationality_id', '=', $request->input('nationality_id'))
            ;

            $sentOfficialLetterQuery
                ->where('nationality_id', '=', $request->input('nationality_id'))
            ;

            $missingDocumentQuery
                ->where('nationality_id', '=', $request->input('nationality_id'))
            ;
        }

        if ($user->isAllAdmin()) {
            // admin ise burasi calisir
            if (! is_null($request->input('agency_id'))) {
                $agencyId = $request->input('agency_id') != 'self' ? $request->input('agency_id') : null;

                if (! is_null($agencyId)) {
                    $pendingApplicationQuery
                        ->where('agency_id', '=', $agencyId)
                    ;

                    $sentPreLetterQuery
                        ->where('agency_id', '=', $agencyId)
                    ;

                    $pendingPaymentQuery
                        ->where('agency_id', '=', $agencyId)
                    ;

                    $sentOfficialLetterQuery
                        ->where('agency_id', '=', $agencyId)
                    ;

                    $missingDocumentQuery
                        ->where('agency_id', '=', $agencyId)
                    ;
                } else {
                    $pendingApplicationQuery
                        ->whereNull('agency_id')
                    ;

                    $sentPreLetterQuery
                        ->whereNull('agency_id')
                    ;

                    $pendingPaymentQuery
                        ->whereNull('agency_id')
                    ;

                    $sentOfficialLetterQuery
                        ->whereNull('agency_id')
                    ;

                    $missingDocumentQuery
                        ->whereNull('agency_id')
                    ;
                }
            }
        } else {
            // acente ise burasi calisir

            $pendingApplicationQuery
                ->where('agency_id', '=', $user->agency_id)
            ;

            $pendingPaymentQuery
                ->where('agency_id', '=', $user->agency_id)
            ;

            $sentPreLetterQuery
                ->where('agency_id', '=', $user->agency_id)
            ;

            $pendingPaymentQuery
                ->where('agency_id', '=', $user->agency_id)
            ;

            $sentOfficialLetterQuery
                ->where('agency_id', '=', $user->agency_id)
            ;

            $missingDocumentQuery
                ->where('agency_id', '=', $user->agency_id)
            ;
        }

        $pendingApplicationQuery
            ->whereIn('status', [
                ApplicationStatusEnum::PENDING->value
            ])
        ;

        $sentPreLetterQuery
            ->whereIn('status', [
                ApplicationStatusEnum::SENT_PRE_APPROVAL_LETTER->value
            ])
        ;

        $pendingPaymentQuery
            ->whereIn('status', [
                ApplicationStatusEnum::PENDING_FINANCIAL_APPROVAL->value
            ])
        ;

        $sentOfficialLetterQuery
            ->whereIn('status', [
                ApplicationStatusEnum::OFFICIAL_LETTER_SENT->value
            ])
        ;

        $missingDocumentQuery
            ->whereIn('status', [
                ApplicationStatusEnum::MISSING_DOCUMENT->value
            ])
        ;

        return response()->json([
            'data' => [
                'pending_application' => $pendingApplicationQuery->count(['id']),
                'sent_pre_letter' => $sentPreLetterQuery->count(['id']),
                'pending_payment' => $pendingPaymentQuery->count(['id']),
                'sent_official_letter' => $sentOfficialLetterQuery->count(['id']),
                'missing_document' => $missingDocumentQuery->count(['id']),
            ]
        ]);
    }

    public function download(Application $application)
    {
        /** @var User $user */
        $user = auth()->user();

        if (! $user->isAuthorized()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        if ($user->isAgency() && ! $application->isSameAgency($user->agency_id)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $files = [];
        $disk = Storage::disk('public');

        if ($application->hasPassportPhoto()) {
            $passportPhoto = $application->getRawOriginal('passport_photo');

            $files[] = [
                'name' => 'Passport Photo.' . pathinfo($passportPhoto)['extension'] ?? '',
                'file' => $application->getRawOriginal('passport_photo')
            ];
        }

        if ($application->hasOfficialTranscript()) {
            $officialTranscript = $application->getRawOriginal('official_transcript');
            $files[] = [
                'name' => 'Official Transcript.' . pathinfo($officialTranscript)['extension'] ?? '',
                'file' => $officialTranscript
            ];
        }

        if ($application->hasOfficialExam()) {
            $officialExam = $application->getRawOriginal('official_exam');

            $files[] = [
                'name' => 'Official Exam.' . pathinfo($officialExam)['extension'] ?? '',
                'file' => $officialExam
            ];
        }

        if ($application->hasPaymentFile()) {
            $paymentFile = $application->getRawOriginal('payment_file');

            $files[] = [
                'name' => 'Payment.' . pathinfo($paymentFile)['extension'] ?? '',
                'file' => $paymentFile
            ];
        }

        if ($application->hasHighSchoolDiploma()) {
            $highSchoolDiploma = $application->getRawOriginal('high_school_diploma');

            $files[] = [
                'name' => 'High School Diploma.' . pathinfo($highSchoolDiploma)['extension'] ?? '',
                'file' => $highSchoolDiploma
            ];
        }

        if ($application->hasAdditionalDocument()) {
            $additionalDocument = $application->getRawOriginal('additional_document');

            $files[] = [
                'name' => 'Additional Document.' . pathinfo($additionalDocument)['extension'] ?? '',
                'file' => $additionalDocument
            ];
        }

        $zip = new ZipArchive();
        $fileName = $application->code . '.zip';
        $zipPath = $disk->path('archive/' . $fileName);

        try {
            if (! $disk->exists('archive')) {
                $disk->makeDirectory('archive');
            }

            if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
                return redirect()
                    ->back()
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('application.errors.unable-create-zip'));
            }

            foreach ($files as $item) {
                if (! $disk->exists($item['file'])) {
                    continue;
                }

                $zip->addFile($disk->path($item['file']), $item['name']);
            }

            $zip->close();
        } catch (\Exception $e) {
            logger()->error($e);
        }

        return response()
            ->download($zipPath)
        ;
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
                    'date_of_birth' => Carbon::createFromFormat('d/m/Y', $request->input('date_of_birth')),
                    'address' => $request->input('address'),
                    'phone_number' => $request->input('phone_number'),
                    'email' => $request->input('email'),
                    'school_name' => $request->input('school_name'),
                    'school_country_id' => $request->input('school_country_id'),
                    'school_city' => $request->input('school_city'),
                    'year_of_graduation' => Carbon::createFromFormat('d/m/Y', $request->input('year_of_graduation')),
                    'graduation_degree' => $request->input('graduation_degree'),
                    'reference' => $request->input('reference'),
                ]);

                if ($request->hasFile('passport_photo')) {
                    $this->applicationManager->uploadPassportPhoto($application, $request->file('passport_photo'));
                }

                if ($request->hasFile('official_transcript')) {
                    $this->applicationManager->uploadTranscript($application, $request->file('official_transcript'));
                }

                if ($request->hasFile('official_exam')) {
                    $this->applicationManager->uploadOfficialExam($application, $request->file('official_exam'));
                }

                if ($request->hasFile('high_school_diploma')) {
                    $this->applicationManager->uploadHighSchoolDiploma($application, $request->file('high_school_diploma'));
                }

                if ($request->hasFile('additional_document')) {
                    $this->applicationManager->uploadAdditionalDocument($application, $request->file('additional_document'));
                }

                Mail::to('oguz.topcu@antalya.edu.tr')->send(new NewStudentRegisteredMail());

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
                $status = $request->input('status');

                /** @var Application $application */
                $application = Application::query()
                    ->with(['agency'])
                    ->where('id', '=', $request->input('id'))
                    ->first();

                $this->applicationManager->updateStatus($application, $status);
                $emails = [
                    'oguz.topcu@antalya.edu.tr' // basvuru durumu guncellendiginde yonetime mail gidecek
                ];

                if (! is_null($application->email)) {
                    $emails[] = $application->email;
                }

                if ($application->agency) {
                    $emails[] = $application->agency->email;
                }

                if ($status == ApplicationStatusEnum::MISSING_DOCUMENT->value) {
                    $this->applicationManager->update($application, [
                        'missing_document_description' => $request->input('description')
                    ]);
                }

                // basvuru kabul edildi ve kabul mektubu icin mail gonderimi
                if ($status == ApplicationStatusEnum::SENT_PRE_APPROVAL_LETTER->value) {
                    $disk = Storage::disk('public');

                    if (! $disk->exists('attachments')) {
                        $disk->makeDirectory('attachments');
                    }

                    $pdf = Pdf::loadView('pdfs.pre-approval-letter', [
                        'application' => $application
                    ]);

                    $fileName = Str::random() . '.pdf';
                    $path = 'attachments/' . $fileName;
                    $attachments[] = $path;

                    $pdf->save($disk->path($path));

                    foreach ($emails as $email) {
                        Mail::to($email)->queue(new PreApprovalLetterMail($application, $attachments));
                    }
                }

                // basvuru onaylanip resmi davetiye icin mail gonderimi
                if ($status == ApplicationStatusEnum::OFFICIAL_LETTER_SENT->value) {
                    $files = [];
                    if ($request->hasFile('attachments')) {
                        foreach ($request->file('attachments') as $uploadedFile) {
                            $files[] = $uploadedFile->store('uploads', 'public');
                        }
                    }

                    foreach ($emails as $email) {
                        Mail::to($email)->queue(new SendOfficialLetterMail(
                            $application,
                            $request->input('title'),
                            $request->input('content'),
                            $files
                        ));
                    }
                }

                // basvuru durumu guncellendiginde gonderilecek mail
                foreach ($emails as $email) {
                    Mail::to($email)->queue(new UpdateApplicationStatusMail($application));
                }

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
            if ($application->status == ApplicationStatusEnum::OFFICIAL_LETTER_SENT->value) {
                abort(Response::HTTP_FORBIDDEN);
            }

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
                    'date_of_birth' => Carbon::createFromFormat('d/m/Y', $request->input('date_of_birth')),
                    'address' => $request->input('address'),
                    'phone_number' => $request->input('phone_number'),
                    'email' => $request->input('email'),
                    'school_name' => $request->input('school_name'),
                    'school_country_id' => $request->input('school_country_id'),
                    'school_city' => $request->input('school_city'),
                    'year_of_graduation' => Carbon::createFromFormat('d/m/Y', $request->input('year_of_graduation')),
                    'graduation_degree' => $request->input('graduation_degree'),
                    'reference' => $request->input('reference'),
                ]);

                if ($request->hasFile('passport_photo')) {
                    $this->applicationManager->uploadPassportPhoto($application, $request->file('passport_photo'));
                }

                if ($request->hasFile('official_transcript')) {
                    $this->applicationManager->uploadTranscript($application, $request->file('official_transcript'));
                }

                if ($request->hasFile('official_exam')) {
                    $this->applicationManager->uploadOfficialExam($application, $request->file('official_exam'));
                }

                if ($request->hasFile('high_school_diploma')) {
                    $this->applicationManager->uploadHighSchoolDiploma($application, $request->file('high_school_diploma'));
                }

                if ($request->hasFile('additional_document')) {
                    $this->applicationManager->uploadAdditionalDocument($application, $request->file('additional_document'));
                }

                return redirect()
                    ->route('backend.applications.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('application.success.updated'))
                ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.applications.edit', ['applicationId' => $application->id])
                    ->withInput()
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                ;
            }
        });
    }

    public function uploadPayment(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'file' => ['required', 'mimes:pdf', 'max:2048']
            ]);
        } catch (ValidationException $e) {
            return redirect()
                ->route('backend.applications.index')
                ->withInput()
                ->with('alert-type', 'error')
                ->with('alert-message', $e->getMessage())
            ;
        }

        return DB::transaction(function () use ($request) {
            try {
                /** @var Application $application */
                $application = Application::query()
                    ->with(['agency'])
                    ->where('id', '=', $request->input('id'))
                    ->first();

                $this->applicationManager->uploadPaymentFile($application, $request->file('file'));
                $this->applicationManager->update($application, [
                    'status' => ApplicationStatusEnum::PENDING_FINANCIAL_APPROVAL->value
                ]);

                Mail::to('oguz.topcu@antalya.edu.tr')->send(new UploadedFinancialFileMail($application));

                return redirect()
                    ->route('backend.applications.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('application.success.uploaded-payment'))
                    ;
            } catch (\Exception $e) {
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
                [ 'data' => 'agency_code', 'name' => 'agency.code' ],
                [ 'data' => 'agency_name', 'name' => 'agency.name' ],
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

        $model = Application::query()
            ->select(['applications.*']);

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
        ;


        return datatables()
            ->eloquent($model)
            ->filter(function (Builder $query) {
                $status = request()->input('status');
                $nationality = request()->input('nationality');
                $agency = request()->input('agency');

                if (strlen($status) && ! is_null(ApplicationStatusEnum::getValue($status))) {
                    $query->where('status', '=', $status);
                }

                if (strlen($nationality)) {
                    $query->where('nationality_id', '=', $nationality);
                }

                if (! is_null($agency)) {
                    if (intval($agency) > 0) {
                        $query->where('agency_id', '=', $agency);
                    }

                    if ($agency == 'self') {
                        $query->whereNull('agency_id');
                    }
                }
            })
            ->addColumn('agency_code', function ($item) {
                if (! is_null($item->agency)) {
                    return $item->agency->code;
                }

                return '';
            })
            ->addColumn('agency_name', function ($item) {
                if (! is_null($item->agency)) {
                    return $item->agency->name;
                }

                return '';
            })
            ->editColumn('status', function ($item) {
                return match ($item->status) {
                    ApplicationStatusEnum::PENDING->value,
                    ApplicationStatusEnum::SENT_PRE_APPROVAL_LETTER->value,
                    ApplicationStatusEnum::MISSING_DOCUMENT->value => '<span class="badge bg-warning">' . trans('application.statuses.' . str($item->status)->replace('.', '-')) . '</span>',

                    ApplicationStatusEnum::REJECTED->value => '<span class="badge bg-danger">' . trans('application.statuses.' . str($item->status)->replace('.', '-')) . '</span>',

                    ApplicationStatusEnum::PENDING_FINANCIAL_APPROVAL->value => '<span class="badge bg-warning">' . trans('application.statuses.' . str($item->status)->replace('.', '-')) . '</span>',
                    ApplicationStatusEnum::OFFICIAL_LETTER_SENT->value => '<span class="badge bg-primary">' . trans('application.statuses.' . str($item->status)->replace('.', '-')) . '</span>',
                    default => '',
                };
            })
            ->addColumn('actions', function ($item) {
                /** @var User $user */
                $user = auth()->user();

                if ($item->status == ApplicationStatusEnum::OFFICIAL_LETTER_SENT->value) {
                    return '';
                }

                if ($user->isAllAdmin()) {
                    $viewName = 'backend._partials.datatables.applications.' . ApplicationStatusEnum::getStep($item->status);
                    if (view()->exists($viewName)) {
                        return view($viewName)
                            ->with('application', $item)
                        ;
                    }
                }

                if ($item->status == ApplicationStatusEnum::SENT_PRE_APPROVAL_LETTER->value) {
                    $fileName = str(ApplicationStatusEnum::SENT_PRE_APPROVAL_LETTER->value)->replace('.', '')->camel();
                    return view('backend._partials.datatables.applications.' . $fileName)
                        ->with('application', $item);
                }
            })
            ->rawColumns(['step', 'status', 'actions'])
            ->toJson();
    }
}

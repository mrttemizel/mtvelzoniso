<?php

namespace App\Http\Controllers\Backend\Agencies;

use App\Enums\AgencyStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Agencies\AgencyStoreRequest;
use App\Http\Requests\Agencies\AgencyUpdateRequest;
use App\Mail\Users\WelcomeMail;
use App\Managers\AgencyManager;
use App\Managers\UserManager;
use App\Models\Agency;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;

class AgencyController extends Controller
{
    public function __construct(
        protected UserManager $userManager,
        protected AgencyManager $agencyManager
    ) { }

    public function index(): View
    {
        return view('backend.agencies.index');
    }

    public function create(): View
    {
        return view('backend.agencies.create');
    }

    public function store(AgencyStoreRequest $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                /** @var Agency $agency */
                $agency = $this->agencyManager->create([
                    'name' => $request->input('agency_name'),
                    'email' => $request->input('email'),
                    'tax_number' => $request->input('tax_number'),
                ]);

                if ($request->hasFile('tax_certificate')) {
                    $this->agencyManager->uploadCertificate($agency, $request->file('tax_certificate'));
                }

                if ($request->hasFile('contract')) {
                    $this->agencyManager->uploadContract($agency, $request->file('contract'));
                }

                $password = Str::random(8);

                /** @var User $user */
                $user = $this->userManager->create([
                    'agency_id' => $agency->id,
                    'role' => User::ROLE_AGENCY,
                    'name' => $request->input('username'),
                    'email' => $request->input('email'),
                    'password' => $password,
                    'phone' => $request->input('phone'),
                ]);

                $user->setAttribute('raw_password', $password);

                try {
                    // kayit edilen kullanicinin sifresi otomatik olusturuldugu icin mail gonderimi yapilacak
                    Mail::to($request->input('email'))->send(new WelcomeMail($user));
                } catch (\Exception $e) {
                    logger()->error($e);
                    // do nothing!
                }

                return redirect()
                    ->route('backend.agencies.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('agencies.success.created'));
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.agencies.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'));
            }
        });
    }

    public function edit(Agency $agency): View
    {
        return view('backend.agencies.edit')
            ->with('agency', $agency)
        ;
    }

    public function update(AgencyUpdateRequest $request, Agency $agency): RedirectResponse
    {
        return DB::transaction(function () use ($request, $agency) {
            try {
                /** @var Agency $agency */
                $agency = $this->agencyManager->update($agency, [
                    'name' => $request->input('agency_name'),
                    'email' => $request->input('email'),
                    'tax_number' => $request->input('tax_number'),
                ]);

                if ($request->hasFile('tax_certificate')) {
                    $this->agencyManager->uploadCertificate($agency, $request->file('tax_certificate'));
                }

                if ($request->hasFile('contract')) {
                    $this->agencyManager->uploadContract($agency, $request->file('contract'));
                }

                return redirect()
                    ->route('backend.agencies.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('agencies.success.updated'))
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

    public function suspend(Request $request)
    {
        $request->validate([
            'agency_id' => ['required', 'exists:agencies,id'],
            'status' => ['required', new Enum(AgencyStatusEnum::class)]
        ]);

        return DB::transaction(function () use ($request) {
            try {
                /** @var Agency $agency */
                $agency = $this->agencyManager->findById($request->input('agency_id'));
                $status = $request->input('status') == AgencyStatusEnum::ACTIVE->value ? AgencyStatusEnum::ACTIVE->value : AgencyStatusEnum::INACTIVE->value;

                $this->userManager->setSuspendByAgency($agency, $status);

                $this->agencyManager->update($agency, [
                    'status' => $status
                ]);

                return redirect()
                    ->route('backend.agencies.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('agencies.success.suspended'))
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
        $model = Agency::query();

        return datatables()
            ->eloquent($model)
            ->editColumn('status', function ($item) {
                return '';
            })
            ->addColumn('actions', function ($item) {
                return view('backend._partials.datatables._agencies-actions')
                    ->with('item', $item)
                    ->with('editRoute', route('backend.agencies.edit', ['agencyId' => $item->id]))
                ;
            })
            ->toJson();
    }
}

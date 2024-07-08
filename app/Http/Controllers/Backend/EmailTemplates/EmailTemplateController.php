<?php

namespace App\Http\Controllers\Backend\EmailTemplates;

use App\Enums\ApplicationStatusEnum;
use App\Enums\EmailTemplateAttachmentEnum;
use App\Http\Controllers\Controller;
use App\Managers\EmailTemplateManager;
use App\Models\EmailTemplate;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EmailTemplateController extends Controller
{
    public function __construct(
        private readonly EmailTemplateManager $emailTemplateManager
    ) { }

    public function index(): View
    {
        return view('backend.email-templates.index');
    }

    public function create(): View
    {
        return view('backend.email-templates.create')
            ->with('statuses', ApplicationStatusEnum::values())
            ->with('attachments', EmailTemplateAttachmentEnum::values())
        ;
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                $this->emailTemplateManager->create([
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'statuses' => $request->input('statuses'),
                    'attachments' => $request->input('attachments')
                ]);

                return redirect()
                    ->route('backend.email-templates.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('email-template.success.created'))
                ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.email-templates.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                ;
            }
        });
    }

    public function edit(EmailTemplate $emailTemplate): View
    {
        $emailTemplate->load(['statuses']);

        return view('backend.email-templates.edit')
            ->with('emailTemplate', $emailTemplate)
            ->with('statuses', ApplicationStatusEnum::values())
            ->with('attachments', EmailTemplateAttachmentEnum::values())
        ;
    }

    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        return DB::transaction(function () use ($request, $emailTemplate) {
            try {
                $this->emailTemplateManager->update($emailTemplate, [
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'statuses' => $request->input('statuses'),
                    'attachments' => $request->input('attachments')
                ]);

                return redirect()
                    ->route('backend.email-templates.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('email-template.success.updated'))
                    ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.email-templates.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                    ;
            }
        });
    }

    public function destroy(Request $request, EmailTemplate $emailTemplate)
    {
        return DB::transaction(function () use ($request, $emailTemplate) {
            try {
                $this->emailTemplateManager->delete($emailTemplate);

                return redirect()
                    ->route('backend.email-templates.index')
                    ->with('alert-type', 'success')
                    ->with('alert-message', trans('email-template.success.deleted'))
                ;
            } catch (QueryException $e) {
                logger()->error($e);
                DB::rollBack();

                return redirect()
                    ->route('backend.email-templates.index')
                    ->with('alert-type', 'error')
                    ->with('alert-message', trans('transactions.failed'))
                ;
            }
        });
    }

    public function dataTable(): JsonResponse
    {
        $model = EmailTemplate::query();

        $model->orderByDesc('id');

        return datatables()
            ->eloquent($model)
            ->addColumn('actions', function ($item) {
                return view('backend._partials.datatables._default-actions')
                    ->with('item', $item)
                    ->with('editRoute', route('backend.email-templates.edit', ['emailTemplateId' => $item->id]))
                    ->with('deleteRoute', route('backend.email-templates.destroy', ['emailTemplateId' => $item->id]))
                ;
            })
            ->rawColumns(['actions'])
            ->toJson()
        ;
    }
}

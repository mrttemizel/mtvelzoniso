<button type="button"
        class="btn btn-light dropdown-toggle"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
>
    {{ trans('datatable.buttons.actions') }}
</button>


<div class="dropdown-menu">
    <form action="{{ route('backend.applications.update-status') }}" method="POST" class="application-status-form">
        @csrf

        <input type="hidden" name="status" value="{{ \App\Enums\ApplicationStatusEnum::SENT_PRE_APPROVAL_LETTER->value }}" />
        <input type="hidden" name="id" value="{{ $application->id }}">

        <button type="button" class="dropdown-item dropdown-item-success btn-application-update">
            <i class="bx bx-check"></i>
            {{ trans('application.buttons.approve-application') }}
        </button>
    </form>

    <form action="{{ route('backend.applications.update-status') }}" method="POST" class="application-status-form">
        @csrf

        <input type="hidden" name="status" value="{{ \App\Enums\ApplicationStatusEnum::MISSING_DOCUMENT->value }}" />
        <input type="hidden" name="id" value="{{ $application->id }}">

        <button type="button" class="dropdown-item btn-application-update">
            <i class="bx bx-right-arrow-alt"></i>
            {{ trans('application.buttons.missing-document') }}
        </button>
    </form>

    <a href="{{ route('backend.applications.edit', ['applicationId' => $application->id]) }}" class="dropdown-item">
        <i class="bx bx-edit-alt"></i>
        {{ trans('application.buttons.edit') }}
    </a>

    <form action="{{ route('backend.applications.update-status') }}" method="POST" class="application-status-form">
        @csrf

        <input type="hidden" name="status" value="{{ \App\Enums\ApplicationStatusEnum::REJECTED->value }}" />
        <input type="hidden" name="id" value="{{ $application->id }}">

        <button type="button" class="dropdown-item dropdown-item-danger btn-application-update">
            <i class="bx bx-block"></i>
            {{ trans('application.buttons.reject-application') }}
        </button>
    </form>
</div>

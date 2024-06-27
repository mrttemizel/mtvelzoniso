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

        <input type="hidden" name="status" value="{{ \App\Enums\ApplicationStatusEnum::OFFICIAL_LETTER_SENT->value }}" />
        <input type="hidden" name="id" value="{{ $application->id }}">

        <button type="button" class="dropdown-item dropdown-item-success btn-application-update">
            <i class="bx bx-right-arrow-alt"></i>
            {{ trans('application.buttons.approve-payment') }}
        </button>
    </form>

    <a href="{{ route('backend.applications.edit', ['applicationId' => $application->id]) }}" class="dropdown-item">
        <i class="bx bx-edit-alt"></i>
        {{ trans('application.buttons.edit') }}
    </a>
</div>

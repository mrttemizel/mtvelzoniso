<button type="button"
        class="btn btn-light dropdown-toggle"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
>
    {{ trans('datatable.buttons.actions') }}
</button>


<div class="dropdown-menu">
    <a href="{{ route('backend.applications.download', ['applicationId' => $application->id]) }}" class="dropdown-item">
        <i class="bx bx-download"></i>
        {{ trans('application.buttons.zip-download') }}
    </a>

    @if ($application->hasPaymentFile())
        <button type="button"
                class="dropdown-item dropdown-item-success btn-sent-letter"
                data-id="{{ $application->id }}"
        >
            <i class="bx bx-right-arrow-alt"></i>
            {{ trans('application.buttons.approve-payment') }}
        </button>
    @endif

    <a href="{{ route('backend.applications.edit', ['applicationId' => $application->id]) }}" class="dropdown-item">
        <i class="bx bx-edit-alt"></i>
        {{ trans('application.buttons.edit') }}
    </a>
</div>

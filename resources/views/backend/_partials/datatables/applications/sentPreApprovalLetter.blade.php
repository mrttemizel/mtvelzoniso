<button type="button"
        class="btn btn-light dropdown-toggle"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
>
    {{ trans('datatable.buttons.actions') }}
</button>


<div class="dropdown-menu">
    <button class="btn btn-default dropdown-item btn-upload-payment" data-id="{{ $application->id }}">
        <i class="bx bx-cloud-upload"></i>
        {{ trans('application.buttons.upload-payment-document') }}
    </button>
</div>

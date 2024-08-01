<button type="button"
        class="btn btn-light dropdown-toggle"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
>
    {{ trans('datatable.buttons.actions') }}
</button>
<div class="dropdown-menu">
    @if (isset($editRoute))
        <a class="dropdown-item" href="{{ $editRoute }}">
            <i class="bx bx-edit-alt"></i>
            {{ trans('datatable.buttons.edit') }}
        </a>
    @endif

    <form action="{{ route('backend.departments.update-status') }}" method="POST">
        @csrf
        <input type="hidden" name="department_id" value="{{ $item->id }}" />
        @php
            $status = null;

            if ($item->status == \App\Enums\DepartmentStatusEnum::ACTIVE->value) {
                $status = \App\Enums\DepartmentStatusEnum::INACTIVE->value;
            } else {
                $status = \App\Enums\DepartmentStatusEnum::ACTIVE->value;
            }
        @endphp
        <input type="hidden" name="status" value="{{ $status }}">

        <button type="submit" class="dropdown-item">
            @if ($item->status == \App\Enums\DepartmentStatusEnum::ACTIVE->value)
                <i class="ri-eye-off-line"></i>
                {{ trans('department.buttons.inactive') }}
            @else
                <i class="ri-eye-line"></i>
                {{ trans('department.buttons.active') }}
            @endif
        </button>
    </form>

    @if (isset($deleteRoute))
        <form action="{{ $deleteRoute }}" method="POST" class="dt-delete-form">
            @csrf

            <button type="submit" class="dropdown-item dropdown-item-danger btn-action-delete">
                <i class="bx bx-trash"></i>
                {{ trans('datatable.buttons.delete') }}
            </button>
        </form>
    @endif
</div>

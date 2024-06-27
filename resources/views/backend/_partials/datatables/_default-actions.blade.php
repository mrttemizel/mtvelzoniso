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

    @yield('content')

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

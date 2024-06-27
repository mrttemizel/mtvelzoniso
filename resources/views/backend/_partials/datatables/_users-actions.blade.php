@extends('backend._partials.datatables._default-actions')

@section('content')
    @if (isset($resetPasswordLink))
        <form action="{{ $resetPasswordLink }}" method="POST">
            @csrf

            <button type="submit" class="dropdown-item">
                <i class="bx bx-reset"></i>
                {{ trans('users.buttons.reset-password') }}
            </button>
        </form>
    @endif
@endsection

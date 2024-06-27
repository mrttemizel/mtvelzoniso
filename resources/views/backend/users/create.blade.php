@extends('backend.layouts.master')

@push('site_title', trans('users.titles.create'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('users.titles.index') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard.index') }}">{{ trans('sidebar.dashboard') }}</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.users.index') }}">{{ trans('sidebar.users') }}</a>
                        </li>

                        <li class="breadcrumb-item active">{{ trans('users.titles.create') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-12 mb-3 role-select">
                                <div class="form-group {{ $errors->has('role') ? 'has-error' : null }}">
                                    <label for="role">{{ trans('users.inputs.roles.label') }}</label>
                                    <select name="role" id="role" class="form-control {{ $errors->has('role') ? 'is-invalid' : null }}">
                                        <option value="" disabled selected>{{ trans('users.inputs.roles.placeholder') }}</option>
                                        <option value="{{ \App\Models\User::ROLE_ADMIN }}" {{ old('role') == \App\Models\User::ROLE_ADMIN ? 'selected' : null }}>{{ trans('users.inputs.roles.options.' . \App\Models\User::ROLE_ADMIN) }}</option>
                                        <option value="{{ \App\Models\User::ROLE_AGENCY }}" {{ old('role') == \App\Models\User::ROLE_AGENCY ? 'selected' : null }}>{{ trans('users.inputs.roles.options.' . \App\Models\User::ROLE_AGENCY) }}</option>
                                        <option value="{{ \App\Models\User::ROLE_STUDENT }}" {{ old('role') == \App\Models\User::ROLE_STUDENT ? 'selected' : null }}>{{ trans('users.inputs.roles.options.' . \App\Models\User::ROLE_STUDENT) }}</option>
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback">{{ $errors->first('role') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3 agencies {{ old('role') != \App\Models\User::ROLE_AGENCY ? 'd-none' : null }}">
                                <div class="form-group {{ $errors->has('agency_id') ? 'has-error' : null }}">
                                    <label for="agency">{{ trans('users.inputs.agency') }}</label>
                                    <select name="agency_id" class="form-control {{ $errors->has('agency_id') ? 'is-invalid' : null }}" id="agency">
                                        @forelse ($agencies as $agency)
                                            <option value="{{ $agency->id }}" {{ old('agency_id') == $agency->id ? 'selected' : null }}>{{ $agency->name }}</option>
                                            @empty
                                            <option value="" disabled selected>{{ trans('users.texts.no-agencies') }}</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('agency_id'))
                                        <span class="invalid-feedback">{{ $errors->first('agency_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
                                    <label for="name">{{ trans('users.inputs.name') }}</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}" value="{{ old('name') }}" />
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
                                    <label for="name">{{ trans('users.inputs.email') }}</label>
                                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : null }}" value="{{ old('email') }}" />
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group {{ $errors->has('phone') ? 'has-error' : null }}">
                                    <label for="name">{{ trans('users.inputs.phone') }}</label>
                                    <input type="text" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : null }}" value="{{ old('phone') }}" />
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group {{ $errors->has('avatar') ? 'has-error' : null }}">
                                    <label for="name">{{ trans('users.inputs.avatar') }}</label>
                                    <input type="file" name="avatar" class="form-control {{ $errors->has('avatar') ? 'is-invalid' : null }}" />
                                    @if ($errors->has('avatar'))
                                        <span class="invalid-feedback">{{ $errors->first('avatar') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bxs-save"></i>
                                    <span>{{ trans('agencies.buttons.save') }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('javascript')
    <script>
        $(document).ready(function () {
            const body = $('body');

            body.on('change', 'select[name="role"]', function (e) {
                let select = $(this);
                let option = select.find('option:selected');
                let wrapper = body.find('.agencies');

                select.parents('.role-select').removeClass('col-lg-6');
                wrapper.addClass('d-none');

                if (option.val() === '{{ \App\Models\User::ROLE_AGENCY }}') {
                    wrapper.removeClass('d-none');
                    select.parents('.role-select').addClass('col-lg-6');
                }
            });
        });
    </script>
@endpush

@extends('backend.layouts.master')

@push('site_title', trans('academicYear.titles.edit'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('academicYear.titles.edit') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard.index') }}">{{ trans('sidebar.dashboard') }}</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.academic-years.index') }}">{{ trans('sidebar.academicYears') }}</a>
                        </li>

                        <li class="breadcrumb-item active">{{ trans('academicYear.titles.edit') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <form action="{{ route('backend.academic-years.update', ['academicYearId' => $academicYear->id]) }}" method="POST">
            @csrf

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('academicYear.titles.edit') }}</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
                                    <label for="name">{{ trans('academicYear.inputs.name') }}</label>
                                    <input type="text" name="name"
                                           class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}"
                                           value="{{ old('name', $academicYear->name) }}"
                                           id="name"
                                    />
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bxs-save"></i>
                                    <span>{{ trans('agencies.buttons.save') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@extends('backend.layouts.master')

@push('site_title', trans('department.titles.create'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('department.titles.create') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard.index') }}">{{ trans('sidebar.dashboard') }}</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.departments.index') }}">{{ trans('sidebar.departments') }}</a>
                        </li>

                        <li class="breadcrumb-item active">{{ trans('department.titles.create') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.departments.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
                                            <label for="name">{{ trans('department.inputs.name') }}</label>
                                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}" value="{{ old('name') }}" />
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group {{ $errors->has('faculty') ? 'has-error' : null }}">
                                            <label for="name">{{ trans('department.inputs.faculty') }}</label>
                                            <input type="text" name="faculty" class="form-control {{ $errors->has('faculty') ? 'is-invalid' : null }}" value="{{ old('faculty') }}" />
                                            @if ($errors->has('faculty'))
                                                <span class="invalid-feedback">{{ $errors->first('faculty') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group {{ $errors->has('annual_fee') ? 'has-error' : null }}">
                                    <label for="name">{{ trans('department.inputs.annual_fee') }}</label>
                                    <input type="text" name="annual_fee" class="form-control {{ $errors->has('annual_fee') ? 'is-invalid' : null }}" placeholder="1234.98" value="{{ old('annual_fee') }}" />
                                    <span class="text-info">{{ trans('department.texts.only-dollars') }}</span>
                                    @if ($errors->has('annual_fee'))
                                        <span class="invalid-feedback">{{ $errors->first('annual_fee') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-group {{ $errors->has('discounted_fee') ? 'has-error' : null }}">
                                    <label for="name">{{ trans('department.inputs.discounted_fee') }}</label>
                                    <input type="text" name="discounted_fee" class="form-control {{ $errors->has('discounted_fee') ? 'is-invalid' : null }}" placeholder="1234.98" value="{{ old('discounted_fee') }}" />
                                    <span class="text-info">{{ trans('department.texts.only-dollars') }}</span>
                                    @if ($errors->has('discounted_fee'))
                                        <span class="invalid-feedback">{{ $errors->first('discounted_fee') }}</span>
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

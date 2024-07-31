@extends('backend.layouts.master')

@push('site_title', trans('agencies.titles.create'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('agencies.titles.index') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard.index') }}">{{ trans('sidebar.dashboard') }}</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.agencies.index') }}">{{ trans('sidebar.agencies') }}</a>
                        </li>

                        <li class="breadcrumb-item active">{{ trans('agencies.titles.create') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <form action="{{ route('backend.agencies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('agencies.headings.agency-info') }}</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="form-group {{ $errors->has('agency_name') ? 'has-error' : null }}">
                                            <label for="agency_name">{{ trans('agencies.inputs.agency_name') }}</label>
                                            <input type="text" name="agency_name"
                                                   class="form-control {{ $errors->has('agency_name') ? 'is-invalid' : null }}"
                                                   value="{{ old('agency_name') }}"
                                                   id="agency_name"
                                            />
                                            @if ($errors->has('agency_name'))
                                                <span class="invalid-feedback">{{ $errors->first('agency_name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <div class="form-group {{ $errors->has('tax_number') ? 'has-error' : null }}">
                                            <label for="tax_number">{{ trans('agencies.inputs.tax_number') }}</label>
                                            <input type="text"
                                                   name="tax_number"
                                                   class="form-control {{ $errors->has('tax_number') ? 'is-invalid' : null }}"
                                                   value="{{ old('tax_number') }}"
                                                   id="tax_number"
                                            />
                                            @if ($errors->has('tax_number'))
                                                <span class="invalid-feedback">{{ $errors->first('tax_number') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <div class="form-group {{ $errors->has('agency_email') ? 'has-error' : null }}">
                                            <label for="agency_email">{{ trans('agencies.inputs.email') }}</label>
                                            <input type="email"
                                                   name="agency_email"
                                                   class="form-control {{ $errors->has('agency_email') ? 'is-invalid' : null }}"
                                                   value="{{ old('agency_email') }}"
                                                   id="agency_email"
                                            />
                                            @if ($errors->has('agency_email'))
                                                <span class="invalid-feedback">{{ $errors->first('agency_email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label for="tax_certificate">{{ trans('agencies.inputs.tax_certificate') }}</label>
                                            <input type="file"
                                                   name="tax_certificate"
                                                   class="form-control {{ $errors->has('tax_certificate') ? 'is-invalid' : null }}"
                                                   id="tax_certificate"
                                            />
                                            @if ($errors->has('tax_certificate'))
                                                <span class="invalid-feedback">{{ $errors->first('tax_certificate') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <div class="form-group {{ $errors->has('contract') ? 'has-error' : null }}">
                                            <label for="contract">{{ trans('agencies.inputs.contract') }}</label>
                                            <input type="file"
                                                   name="contract"
                                                   class="form-control {{ $errors->has('contract') ? 'is-invalid' : null }}"
                                                   id="contract"
                                            />
                                            @if ($errors->has('contract'))
                                                <span class="invalid-feedback">{{ $errors->first('contract') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('agencies.headings.user-info') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group {{ $errors->has('username') ? 'has-error' : null }}">
                                    <label for="username">{{ trans('agencies.inputs.username') }}</label>
                                    <input type="text"
                                           name="username"
                                           class="form-control {{ $errors->has('username') ? 'is-invalid' : null }}"
                                           value="{{ old('username') }}"
                                    />
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
                                    <label for="email">{{ trans('agencies.inputs.email') }}</label>
                                    <input type="email"
                                           name="email"
                                           class="form-control {{ $errors->has('email') ? 'is-invalid' : null }}"
                                           value="{{ old('email') }}"
                                    />
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group {{ $errors->has('phone') ? 'has-error' : null }}">
                                    <label for="phone">{{ trans('agencies.inputs.phone') }}</label>
                                    <input type="text"
                                           name="phone"
                                           class="form-control {{ $errors->has('phone') ? 'is-invalid' : null }}"
                                           value="{{ old('phone') }}"
                                    />
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
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

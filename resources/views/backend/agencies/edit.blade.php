@extends('backend.layouts.master')

@push('site_title', trans('agencies.titles.edit'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('agencies.titles.edit') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard.index') }}">{{ trans('sidebar.dashboard') }}</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.agencies.index') }}">{{ trans('sidebar.agencies') }}</a>
                        </li>

                        <li class="breadcrumb-item active">{{ trans('agencies.titles.edit') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <form action="{{ route('backend.agencies.update', ['agencyId' => $agency->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('agencies.headings.agency-info') }}</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-4">
                                @if (! is_null($agency->getOriginal('contract')))

                                @endif

                                <a href="{{ $agency->hasContract() ? $agency->contract : '#' }}"
                                   {!! ! $agency->hasContract() ? 'onclick="return false"' : null !!}
                                   class="btn btn-primary {{ ! $agency->hasContract() ? 'disabled' : null }}"
                                   target="_blank"
                                >
                                    {{ trans('agencies.buttons.preview-contract') }}
                                </a>

                                <a href="{{ $agency->hasTaxCertificate() ? $agency->tax_certificate : '#' }}"
                                   {!! ! $agency->hasTaxCertificate() ? 'onclick="return false"' : null !!}
                                   class="btn btn-primary ml-3 {{ ! $agency->hasTaxCertificate() ? 'disabled cursor-disabled' : null }}"
                                   target="_blank"
                                >
                                    {{ trans('agencies.buttons.preview-certificate') }}
                                </a>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="form-group {{ $errors->has('agency_name') ? 'has-error' : null }}">
                                            <label for="agency_name">{{ trans('agencies.inputs.agency_name') }}</label>
                                            <input type="text" name="agency_name"
                                                   class="form-control {{ $errors->has('agency_name') ? 'is-invalid' : null }}"
                                                   value="{{ old('agency_name', $agency->name) }}"
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
                                                   value="{{ old('tax_number', $agency->tax_number) }}"
                                                   id="tax_number"
                                            />
                                            @if ($errors->has('tax_number'))
                                                <span class="invalid-feedback">{{ $errors->first('tax_number') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
                                            <label for="email">{{ trans('agencies.inputs.email') }}</label>
                                            <input type="email"
                                                   name="email"
                                                   class="form-control {{ $errors->has('email') ? 'is-invalid' : null }}"
                                                   value="{{ old('email', $agency->email) }}"
                                                   id="email"
                                            />
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
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

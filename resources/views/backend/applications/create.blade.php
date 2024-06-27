@extends('backend.layouts.master')

@push('site_title', trans('application.titles.create'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ trans('application.titles.create') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('backend.applications.store') }}" enctype="multipart/form-data">
                        @csrf

                        <h6 class="fw-bolder text-uppercase">{{ trans('application.tabs.department-details') }}</h6>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group {{ $errors->has('department_id') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.department_id') }}
                                    </label>
                                    <select name="department_id" class="form-control {{ $errors->has('department_id') ? 'is-invalid' : null }}">
                                        <option value="" disabled selected>{{ trans('application.inputs.department_id') }}</option>
                                        @foreach (departments() as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('department_id'))
                                        <span class="invalid-feedback">{{ $errors->first('department_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <h6 class="fw-bolder text-uppercase">{{ trans('application.tabs.personal-details') }}</h6>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.name') }}
                                    </label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}"
                                           placeholder="{{ trans('application.inputs.name') }}"
                                           name="name"
                                           value="{{ old('name') }}"
                                    />
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('nationality') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.nationality') }}
                                    </label>
                                    <select name="nationality_id" class="form-control {{ $errors->has('nationality_id') ? 'is-invalid' : null }}">
                                        <option value="" disabled selected>{{ trans('application.inputs.nationality') }}</option>
                                        @foreach (countries() as $country)
                                            <option value="{{ $country->id }}" {{ old('nationality_id') == $country->id ? 'selected' : null }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('nationality_id'))
                                        <span class="invalid-feedback">{{ $errors->first('nationality_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('passport_number') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.passport_number') }}
                                    </label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('passport_number') ? 'is-invalid' : null }}"
                                           placeholder="{{ trans('application.inputs.passport_number') }}"
                                           name="passport_number"
                                           value="{{old('passport_number')}}"
                                    />
                                    @if ($errors->has('passport_number'))
                                        <span class="invalid-feedback">{{ $errors->first('passport_number') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('place_of_birth') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.place_of_birth') }}
                                    </label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('place_of_birth') ? 'is-invalid' : null }}"
                                           placeholder="{{ trans('application.inputs.place_of_birth') }}"
                                           name="place_of_birth"
                                           value="{{ old('place_of_birth') }}"
                                    />
                                    @if ($errors->has('place_of_birth'))
                                        <span class="invalid-feedback">{{ $errors->first('place_of_birth') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('date_of_birth') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.date_of_birth') }}
                                    </label>
                                    <input type="text"
                                           class="form-control  {{ $errors->has('date_of_birth') ? 'is-invalid' : null }}"
                                           placeholder="YYYY-MM-DD"
                                           name="date_of_birth"
                                           value="{{ old('date_of_birth') }}"
                                    />
                                    @if ($errors->has('date_of_birth'))
                                        <span class="invalid-feedback">{{ $errors->first('date_of_birth') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('passport_photo') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.passport_photo') }}
                                    </label>
                                    <input type="file"
                                           class="form-control {{ $errors->has('passport_photo') ? 'is-invalid' : null }}"
                                           placeholder="YYYY-MM-DD"
                                           name="passport_photo"
                                    />
                                    <span class="text-info">{{ trans('application.texts.warning-upload-image') }}</span>
                                    @if ($errors->has('passport_photo'))
                                        <span class="invalid-feedback">{{ $errors->first('passport_photo') }}</span>
                                    @endif
                                </div>
                            </div>

                            <h6 class="fw-bolder text-uppercase mt-1">{{ trans('application.tabs.contact-details') }}</h6>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('country_id') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.country') }}
                                    </label>
                                    <select name="country_id" class="form-control {{ $errors->has('country_id') ? 'is-invalid' : null }}">
                                        <option value="" disabled selected>{{ trans('application.inputs.country') }}</option>
                                        @foreach (countries() as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : null }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country_id'))
                                        <span class="invalid-feedback">{{ $errors->first('country_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.address') }}
                                    </label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('address') ? 'is-invalid' : null }}"
                                           placeholder="{{ trans('application.inputs.address') }}"
                                           name="address"
                                           value="{{ old('address') }}"
                                    />
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.phone_number') }}
                                    </label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : null }}"
                                           placeholder="{{ trans('application.inputs.phone_number') }}"
                                           name="phone_number"
                                           value="{{ old('phone_number') }}"
                                    />
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.email') }}
                                    </label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('email') ? 'is-invalid' : null }}"
                                           placeholder="{{ trans('application.inputs.email') }}"
                                           name="email"
                                           value="{{ old('email') }}"
                                    />
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <h6 class="fw-bolder text-uppercase mt-4">{{ trans('application.tabs.school-details') }}</h6>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('school_name') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.school_name') }}
                                    </label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('school_name') ? 'is-invalid' : null }}"
                                           placeholder="{{ trans('application.inputs.school_name') }}"
                                           name="school_name"
                                           value="{{ old('school_name') }}"
                                    />
                                    @if ($errors->has('school_name'))
                                        <span class="invalid-feedback">{{ $errors->first('school_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('school_country_id') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.school_country') }}
                                    </label>
                                    <select name="school_country_id" class="form-control {{ $errors->has('school_country_id') ? 'is-invalid' : null }}">
                                        <option value="" disabled selected>{{ trans('application.inputs.school_country') }}</option>
                                        @foreach (countries() as $country)
                                            <option value="{{ $country->id }}" {{ old('school_country_id') == $country->id ? 'selected' : null }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('school_country_id'))
                                        <span class="invalid-feedback">{{ $errors->first('school_country_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('school_city') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.school_city') }}
                                    </label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('school_city') ? 'is-invalid' : null }}"
                                           placeholder="{{ trans('application.inputs.school_city') }}"
                                           name="school_city"
                                           value="{{ old('school_city') }}"
                                    />
                                    @if ($errors->has('school_city'))
                                        <span class="invalid-feedback">{{ $errors->first('school_city') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('year_of_graduation') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.year_graduation') }}
                                    </label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('year_of_graduation') ? 'is-invalid' : null }}"
                                           placeholder="YYYY-MM-DD"
                                           name="year_of_graduation"
                                           value="{{ old('year_of_graduation') }}"
                                    />
                                    @if ($errors->has('year_of_graduation'))
                                        <span class="invalid-feedback">{{ $errors->first('year_of_graduation') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('graduation_degree') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.graduation_degree') }}
                                    </label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('graduation_degree') ? 'is-invalid' : null }}"
                                           placeholder="{{ trans('application.inputs.graduation_degree') }}"
                                           name="graduation_degree"
                                           value="{{ old('graduation_degree') }}"
                                    />
                                    @if ($errors->has('graduation_degree'))
                                        <span class="invalid-feedback">{{ $errors->first('graduation_degree') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('official_transcript') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.official_transcript') }}
                                    </label>
                                    <input type="file"
                                           class="form-control {{ $errors->has('official_transcript') ? 'is-invalid' : null }}"
                                           name="official_transcript"
                                    />
                                    <span class="text-info">{{ trans('application.texts.warning-upload-transcript') }}</span>
                                    @if ($errors->has('official_transcript'))
                                        <span class="invalid-feedback">{{ $errors->first('official_transcript') }}</span>
                                    @endif
                                </div>
                            </div>

                            <h6 class="fw-bolder text-uppercase mt-4">{{ trans('application.tabs.test-and-score-details') }}</h6>

                            <div class="col-12">
                                <div class="form-group {{ $errors->has('official_exam') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        {{ trans('application.inputs.official_exam') }}
                                    </label>
                                    <input type="file"
                                           class="form-control {{ $errors->has('official_exam') ? 'is-invalid' : null }}"
                                           name="official_exam"
                                    />
                                    <span class="text-info">{{ trans('application.texts.warning-upload-exam') }}</span>

                                    @if ($errors->has('official_exam'))
                                        <span class="invalid-feedback">{{ $errors->first('official_exam') }}</span>
                                    @endif
                                </div>
                            </div>

                            <h6 class="fw-bolder text-uppercase mt-4">{{ trans('application.tabs.program-details') }}</h6>

                            <div class="col-12">
                                <div class="form-group {{ $errors->has('reference') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.reference') }}
                                    </label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('reference') ? 'is-invalid' : null }}"
                                           placeholder="{{ trans('application.inputs.reference') }}"
                                           name="reference"
                                           value="{{ old('reference') }}"
                                    />
                                    @if ($errors->has('reference'))
                                        <span class="invalid-feedback">{{ $errors->first('reference') }}</span>
                                    @endif
                                </div>
                            </div>

                            <h6 class="fw-bolder text-uppercase mt-4">{{ trans('application.tabs.application-terms') }}</h6>


                            <div class="col-12">
                                <div class="form-check form-switch form-switch-danger">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                           name="application_term" id="applicationTerm" {{ old('application_term', true) == true ? 'checked' : null }}>
                                    <label class="form-check-label" for="applicationTerm">
                                        {!! trans('application.texts.application-terms') !!}
                                    </label>
                                </div>
                                <span class="text-danger">
                                    @error('application_term')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch form-switch-danger">
                                    <input class="form-check-input" type="checkbox" role="switch" name="gdpr"
                                           id="SwitchCheck5" {{ old('gdpr', true) == true ? 'checked' : null }}>
                                    <label class="form-check-label" for="SwitchCheck5">
                                        <a href="https://antalya.edu.tr/tr/kvkk-aydinlatma-metni" target="_blank">
                                            {{ trans('application.texts.gdpr') }}
                                        </a><br>
                                    </label>
                                </div>
                                <span class="text-danger">
                                    @error('kvkk')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('application.buttons.send') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

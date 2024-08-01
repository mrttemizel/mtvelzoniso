@extends('backend.layouts.master')

@push('site_title', trans('application.titles.edit'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ trans('application.titles.edit') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('backend.applications.update', ['applicationId' => $application->id]) }}" enctype="multipart/form-data">
                        @csrf

                        <h6 class="fw-bolder text-uppercase">{{ trans('application.tabs.department-details') }}</h6>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('department_id') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.department_id') }}
                                    </label>
                                    <select name="department_id" class="form-control {{ $errors->has('department_id') ? 'is-invalid' : null }}">
                                        <option value=""}>{{ trans('application.inputs.department_id') }}</option>
                                        @foreach (departments() as $department)
                                            <option value="{{ $department->id }}" {{ old('department_id', $department->id) == $application->department_id ? 'selected' : null }}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('department_id'))
                                        <span class="invalid-feedback">{{ $errors->first('department_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('academic_year_id') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.academic_year_id') }}
                                    </label>
                                    <select name="academic_year_id" class="form-control {{ $errors->has('academic_year_id') ? 'is-invalid' : null }}">
                                        <option value="" disabled selected>{{ trans('application.inputs.academic_year_id') }}</option>
                                        @foreach (academicYears() as $academicYear)
                                            <option value="{{ $academicYear->id }}" {{ old('academic_year_id', $application->academic_year_id) == $academicYear->id ? 'selected' : null }}>{{ $academicYear->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('academic_year_id'))
                                        <span class="invalid-feedback">{{ $errors->first('academic_year_id') }}</span>
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
                                           value="{{ old('name', $application->name) }}"
                                    />
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('passport_photo') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        {{ trans('application.inputs.passport_photo') }}
                                        @if ($application->hasPassportPhoto())
                                            <a href="{{ $application->passport_photo }}" class="fw-bold" style="margin-left: 10px" target="_blank">
                                                {{ trans('application.buttons.preview') }}
                                            </a>
                                        @endif
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
                                <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        {{ trans('application.inputs.phone_number') }}
                                    </label>
                                    <input type="text"
                                           class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : null }}"
                                           placeholder="{{ trans('application.inputs.phone_number') }}"
                                           name="phone_number"
                                           value="{{ old('phone_number', $application->phone_number) }}"
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
                                           value="{{ old('email', $application->email) }}"
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
                                           value="{{ old('school_name', $application->school_name) }}"
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
                                            <option value="{{ $country->id }}" {{ old('school_country_id', $application->school_country_id) == $country->id ? 'selected' : null }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('school_country_id'))
                                        <span class="invalid-feedback">{{ $errors->first('school_country_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('school_diploma') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        {{ trans('application.inputs.school_diploma') }}
                                        @if ($application->hasSchoolDiploma())
                                            <a href="{{ $application->school_diploma }}" class="fw-bold" style="margin-left: 10px" target="_blank">
                                                {{ trans('application.buttons.preview') }}
                                            </a>
                                        @endif
                                    </label>
                                    <input type="file"
                                           class="form-control {{ $errors->has('school_diploma') ? 'is-invalid' : null }}"
                                           name="school_diploma"
                                    />
                                    <span class="text-info">{{ trans('application.texts.warning-upload') }}</span>

                                    @if ($errors->has('school_diploma'))
                                        <span class="invalid-feedback">{{ $errors->first('school_diploma') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('official_transcript') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        {{ trans('application.inputs.official_transcript') }}
                                        @if ($application->hasOfficialTranscript())
                                            <a href="{{ $application->official_transcript }}" class="fw-bold" style="margin-left: 10px" target="_blank">
                                                {{ trans('application.buttons.preview') }}
                                            </a>
                                        @endif
                                    </label>
                                    <input type="file"
                                           class="form-control {{ $errors->has('official_transcript') ? 'is-invalid' : null }}"
                                           name="official_transcript"
                                    />
                                    <span class="text-info">{{ trans('application.texts.warning-upload') }}</span>
                                    @if ($errors->has('official_transcript'))
                                        <span class="invalid-feedback">{{ $errors->first('official_transcript') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group {{ $errors->has('additional_document') ? 'has-error' : null }} mb-3">
                                    <label class="form-label">
                                        {{ trans('application.inputs.additional_document') }}
                                        @if ($application->hasAdditionalDocument())
                                            <a href="{{ $application->additional_document }}" class="fw-bold" style="margin-left: 10px" target="_blank">
                                                {{ trans('application.buttons.preview') }}
                                            </a>
                                        @endif
                                    </label>
                                    <input type="file"
                                           class="form-control {{ $errors->has('additional_document') ? 'is-invalid' : null }}"
                                           name="additional_document"
                                    />
                                    <span class="text-info">{{ trans('application.texts.warning-upload') }}</span>
                                    @if ($errors->has('additional_document'))
                                        <span class="invalid-feedback">{{ $errors->first('additional_document') }}</span>
                                    @endif
                                </div>
                            </div>

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
                                           value="{{ old('reference', $application->reference) }}"
                                    />
                                    @if ($errors->has('reference'))
                                        <span class="invalid-feedback">{{ $errors->first('reference') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('application.buttons.save') }}
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

@push('javascript')
    <script>
        $(document).ready(function () {
            const body = $('body');

            body.find('.date').daterangepicker({
                singleDatePicker: true,
                maxDate: parseInt(moment().format('YYYY'), 10),
                locale: {
                    format: 'DD/MM/YYYY'
                }
            })
        });
    </script>
@endpush

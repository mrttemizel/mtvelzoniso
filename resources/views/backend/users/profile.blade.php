@extends('backend.layouts.master')

@push('site_title', trans('profile.titles.my-profile'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Profilim</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">Ana Sayfa</a></li>
                        <li class="breadcrumb-item active">Profilim</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <form action="{{ route('backend.profile.update-avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                <img
                                    src="{{ auth()->user()->profileImage() }}"
                                    class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                    alt="user-profile-image"
                                />
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input"
                                           type="file"
                                           name="avatar"
                                           class="profile-img-file-input"
                                    />

                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <h5 class="fs-16 mb-1">{{ auth()->user()->name }}</h5>
                            <p class="text-muted mb-0">{{ auth()->user()->getRole() }}</p>
                        </div>
                    </div>
                    <div class="hstack gap-2 justify-content-center mb-2">
                        @if ($errors->has('avatar'))
                            <span class="text-danger">{{ $errors->first('avatar') }}</span>
                        @endif
                    </div>
                    <div class="hstack gap-2 justify-content-center mb-2">
                        <button type="submit" class="btn btn-primary">{{ trans('profile.buttons.update') }}</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i> {{ trans('profile.tabs.profile-info') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i> {{ trans('profile.tabs.password-info') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="{{ route('backend.profile.update') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : null }} mb-3">
                                            <label for="firstnameInput" class="form-label">
                                                {{ trans('profile.inputs.full_name') }} :
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}"
                                                   name="name"
                                                   value="{{ $user->name }}"
                                            />
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : null }} mb-3">
                                            <label for="phone" class="form-label">{{ trans('profile.inputs.phone') }} :</label>
                                            <input type="text"
                                                   name="phone"
                                                   class="form-control {{ $errors->has('phone') ? 'is-invalid' : null }}"
                                                   value="{{ $user->phone }}"
                                            />
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : null }} mb-3">
                                            <label for="emailInput" class="form-label">
                                                {{ trans('profile.inputs.email') }}: <span class="text-danger">*</span>
                                            </label>
                                            <input type="email"
                                                   class="form-control {{ $errors->has('email') ? 'is-invalid' : null }}"
                                                   name="email"
                                                   value="{{ $user->email }}"
                                            />
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">{{ trans('profile.buttons.update') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="{{ route('backend.profile.update-password') }}" method="POST" id="changeProfilePasswordForm">
                                @csrf


                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div class="form-group {{ $errors->has('current_password') ? 'has-error' : null }}">
                                            <label for="oldPassword" class="form-label">
                                                {{ trans('profile.inputs.used-password') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="password"
                                                   class="form-control {{ $errors->has('current_password') ? 'is-invalid' : null }}"
                                                   name="current_password"
                                                   id="oldPassword"
                                            />
                                            @if ($errors->has('current_password'))
                                                <span class="invalid-feedback">{{ $errors->first('current_password') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group {{ $errors->has('password') ? 'has-error' : null }}">
                                            <label for="password" class="form-label">
                                                {{ trans('profile.inputs.new-password') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="password"
                                                   class="form-control {{ $errors->has('password') ? 'is-invalid' : null }}"
                                                   name="password"
                                                   id="password"
                                            />
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : null }}">
                                            <label for="passwordConfirmation" class="form-label">
                                                {{ trans('profile.inputs.password-confirmation') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="password"
                                                   class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : null }}"
                                                   name="password_confirmation"
                                                   id="password_confirmation"
                                            />
                                            @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-3">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">{{ trans('profile.buttons.update') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

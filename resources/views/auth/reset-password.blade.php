@extends('backend.layouts.master-withoutnavbar')

@push('site_title', trans('passwords.titles.reset-password'))

@section('content')
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                     viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <div class="auth-page-content">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-lg-12 mt-5"></div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <img src="{{ asset('backend/my-image/abu-renkli.svg') }}" alt="" height="60">
{{--                                    <p class="text-muted mt-4">{{ trans('passwords.texts.warning-same-password') }}</p>--}}
                                </div>

                                <div class="p-2">
                                    <form action="{{ route('auth.reset-password.store', ['token' => $token]) }}"
                                          method="POST">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}"/>
                                        <input type="hidden" name="email" value="{{ $email }}"/>

                                        <div class="form-group mb-3 {{ $errors->has('password') ? 'has-error' : null }}">
                                            <label class="form-label" for="password-input">{{ trans('passwords.inputs.password') }}</label>
                                            <input type="password"
                                                   name="password"
                                                   class="form-control pe-5 password-input {{ $errors->has('password') ? 'is-invalid' : null }}"
                                                   onpaste="return false"
                                                   id="password-input"
                                                   autofocus
                                            />
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                            @endif

                                            <span class="form-text d-block">{{ trans('passwords.texts.password-length') }}</span>
                                        </div>

                                        <div class="form-group mb-3 {{ $errors->has('password_confirmation') ? 'has-error' : null }}">
                                            <label class="form-label" for="confirm-password-input">{{ trans('passwords.inputs.password_repeat') }}</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password"
                                                       name="password_confirmation"
                                                       class="form-control pe-5 password-input {{ $errors->has('password_confirmation') ? 'is-invalid' : null }}"
                                                       onpaste="return false"
                                                />
                                            </div>

                                            @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-info w-100" type="submit">
                                                {{ trans('passwords.buttons.reset-password') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <p class="mb-0">
                                <a href="{{ route('auth.login.index') }}"
                                   class="fw-semibold text-primary">{{ trans('passwords.buttons.login') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

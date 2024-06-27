@extends('backend.layouts.master-withoutnavbar')

@push('site_title', trans('passwords.titles.forgot-password'))

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
                                    <h5 class="text-primary mt-4">{{ trans('passwords.titles.forgot-password') }}</h5>
                                </div>

                                <div class="p-2">
                                    <form action="{{route('auth.forgot-password.store')}}" method="POST">
                                        @csrf
                                        <div class="form-group mb-4 {{ $errors->has('email') ? 'has-error' : null }}">
                                            <label class="form-label">{{ trans('passwords.inputs.email') }}</label>
                                            <input type="email" name="email"
                                                   class="form-control {{ $errors->has('email') ? 'is-invalid' : null }}"
                                                   id="email"
                                                   value="{{ old('email') }}"
                                                   autofocus
                                            />
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-success w-100" id="reset_button" type="submit">
                                                {{ trans('passwords.buttons.send-reset-password') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="mb-0">
                                {{ trans('passwords.texts.remember-password') }}
                                <a href="{{ route('auth.login.index') }}"
                                   class="fw-semibold text-primary text-decoration-underline">
                                    {{ trans('passwords.buttons.login') }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('backend.layouts.master-withoutnavbar')

@push('site_title', trans('login.titles.index'))

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
                        <div class="card mt-5">
                            <div class="card-body p-4 mt-2">
                                <div class="text-center mt-2">
                                    <img src="{{ asset('backend/my-image/abu-renkli.svg') }}" alt="" height="60">
                                    <h5 class="text-primary mt-4">{{ trans('login.headings.welcome') }}</h5>
                                </div>

                                <div class="p-2">
                                    <form action="{{ route('auth.login.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : null }} mb-3">
                                            <label for="email" class="form-label">{{ trans('login.inputs.email') }}</label>
                                            <input type="email"
                                                   name="email"
                                                   class="form-control {{ $errors->has('email') ? 'is-invalid' : null }}"
                                                   value="{{ old('email') }}"
                                                   autofocus
                                            />
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group {{ $errors->has('password') ? 'has-error' : null }} mb-3">
                                            <div class="float-end">
                                                <a href="{{ route('auth.forgot-password.index') }}"
                                                   class="text-muted"><b>{{ trans('login.texts.forgot-password') }}</b></a>
                                            </div>

                                            <label class="form-label">{{ trans('login.inputs.password') }}</label>
                                            <input type="password"
                                                   name="password"
                                                   class="form-control {{ $errors->has('password') ? 'is-invalid' : null }}"
                                            />
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <div id="recaptcha_form"></div>
                                            @if ($errors->has('g-recaptcha-response'))
                                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                            @endif
                                        </div>

                                        <a href="{{ route('auth.register.index') }}" class="text-muted">
                                            <b>{{ trans('login.buttons.register') }}</b>
                                        </a>

                                        <div class="mt-4">
                                            <button class="btn btn-info w-100" id="login_button" type="submit">
                                                {{ trans('login.buttons.login') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    @include('partials.google-recaptcha', ['id' => 'recaptcha_form'])
@endpush

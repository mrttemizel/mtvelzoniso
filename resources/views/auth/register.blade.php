@extends('backend.layouts.master-withoutnavbar')

@push('site_title', trans('register.titles.index'))

@section('content')
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>

        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row justify-content-center g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column d-flex justify-content-center align-items-center">
                                            <div class="mb-4 text-center">
                                                <a href="#" class="d-block">
                                                    <img src="{{ asset('backend/my-image/abu-beyaz.svg') }}" alt="" height="100">
                                                    <h4 class="text-primary mt-4 text-white">{{ trans('register.headings.welcome') }}</h4>
                                                    <h5 class="text-primary mt-4 text-white">{{ trans('register.texts.are-you-agency') }}</h5>
                                                </a>
                                            </div>

                                            <div class="text-center text-white">
                                                <a class="btn btn-info w-100" href="{{ route('auth.login.index') }}">
                                                    <b>{{ trans('register.buttons.login') }}</b>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <p>{{ trans('register.texts.not-user') }}</p>
                                        <form action="{{ route('auth.register.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group {{ $errors->has('name') ? 'has-error' : null }} mb-3">
                                                <label for="name" class="form-label">
                                                    {{ trans('register.inputs.full_name') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       name="name"
                                                       value="{{ old('name') }}"
                                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}"
                                                />
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group mb-3 {{ $errors->has('email') ? 'has-error' : null }}">
                                                <label for="email" class="form-label">
                                                    {{ trans('register.inputs.email') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="email"
                                                       name="email"
                                                       value="{{ old('email') }}"
                                                       class="form-control {{ $errors->has('email') ? 'is-invalid' : null }}"
                                                />
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group mb-3 {{ $errors->has('password') ? 'has-error' : null }}">
                                                <label for="password" class="form-label">
                                                    {{ trans('register.inputs.password') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="password"
                                                       name="password"
                                                       value="{{ old('password') }}"
                                                       class="form-control {{ $errors->has('password') ? 'is-invalid' : null }}"
                                                />
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group mb-3 {{ $errors->has('password_confirmation') ? 'has-error' : null }}">
                                                <label for="password_confirmation" class="form-label">
                                                    {{ trans('register.inputs.password_repeat') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="password"
                                                       name="password_confirmation"
                                                       value="{{ old('password_confirmation') }}"
                                                       class="form-control"
                                                />
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <div id="recaptcha_form_register"></div>
                                                @if ($errors->has('g-recaptcha-response'))
                                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                                @endif
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-info w-100" id="kayit_ol_button" type="submit">
                                                    {{ trans('register.buttons.register') }}
                                                </button>
                                            </div>
                                        </form>

                                        <div class="mt-3 text-center">
                                            {{ trans('register.texts.registered-user') }}
                                            <a class="text-primary" href="{{ route('auth.login.index') }}">
                                                <b>{{ trans('register.buttons.login') }}</b>
                                            </a>
                                        </div>
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
    @include('partials.google-recaptcha', ['id' => 'recaptcha_form_register'])
@endpush

@extends('backend.components.master-withoutnavbar')

@push('title', 'Reset Password')

@section('content')
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
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
                                    <p class="text-muted mt-4">Your new password must be different from the password you used before.</p>
                                </div>
                                @if (session()->get('error'))
                                    <div class="alert alert-danger alert-border-left alert-dismissible fade show"
                                         role="alert">
                                        <i class="ri-error-warning-line me-3 align-middle"></i> <strong>
                                            {{ session()->get('error') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="p-2">
                                    <form action="{{ route('auth.reset-password.store', ['token' => $token]) }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}" />
                                        <input type="hidden" name="email" value="{{ $email }}" />

                                        <div class="form-group mb-3 {{ $errors->has('password') ? 'has-error' : null }}">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password"
                                                       name="password"
                                                       class="form-control pe-5 password-input {{ $errors->has('password') ? 'is-invalid' : null }}"
                                                       onpaste="return false"
                                                       placeholder="Password"
                                                       id="password-input"
                                                />
                                            </div>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                            @endif

                                            <div id="passwordInput" class="form-text">It must be at least 8 characters.</div>
                                        </div>

                                        <div class="form-group mb-3 {{ $errors->has('password_confirmation') ? 'has-error' : null }}">
                                            <label class="form-label" for="confirm-password-input">Confirm Password</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password"
                                                       name="password_confirmation"
                                                       class="form-control pe-5 password-input {{ $errors->has('password_confirmation') ? 'is-invalid' : null }}"
                                                       onpaste="return false"
                                                       placeholder="Confirm Password"
                                                />
                                            </div>

                                            @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Reset My Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <p class="mb-0">
                                <a href="{{ route('auth.login.index') }}" class="fw-semibold text-primary text-decoration-underline"> Login </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

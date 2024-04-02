@extends('backend.components.master-withoutnavbar')
@section('title')
    Home
@endsection
@section('content')

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
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
                                                <a href="index.html" class="d-block">
                                                    <img src="{{ asset('backend/my-image/abu-beyaz.svg') }}" alt="" height="100">
                                                    <h4 class="text-primary mt-4 text-white">Welcome !</h4>
                                                    <h5 class="text-primary mt-4 text-white">If you are an agency, please log in.</h5>
                                                </a>
                                            </div>

                                            <div class="text-center text-white">
                                                <a class="btn btn-info w-100" href="{{route('auth.login')}}" ><b>Login Link</b></a>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <p>If you are not a member please register.</p>
                                        <form action="{{route('auth.store')}}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Ad Soyad : <span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                       class="form-control" placeholder="Ad ve Soyad">
                                                <span class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                    @enderror
                                            </span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">E-Posta Adresi : <span class="text-danger">*</span></label>
                                                <input type="email" name="email" value="{{ old('email') }}"
                                                       class="form-control" placeholder="E-posta Adresiniz">
                                                <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                    @enderror
                                            </span>
                                            </div>


                                            <div class="mb-3">
                                                <label for="password" class="form-label">Şifre : <span class="text-danger">*</span></label>
                                                <input type="password" name="password" value="{{ old('password') }}"
                                                       class="form-control" placeholder="Şifre">
                                                <span class="text-danger">
                                                @error('password')
                                                    {{ $message }}
                                                    @enderror
                                            </span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Şifre Tekrar : <span class="text-danger">*</span></label>
                                                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                       class="form-control" placeholder="Şifre Tekrar">
                                                <span class="text-danger">
                                                @error('password_confirmation')
                                                    {{ $message }}
                                                    @enderror
                                            </span>
                                            </div>

                                            <div class="mb-3">

                                                <div id="recaptcha_form_register"></div>
                                                <span class="text-danger">
                                                @error('g-recaptcha-response')
                                                {{ $message }}
                                                @enderror

                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-info w-100" id="kayit_ol_button" type="submit">Register</button>
                                            </div>

                                        </form>
                                        <div class="mt-3 text-center">
                                            Do you have an account?
                                            <a class="text-primary" href="{{route('auth.login')}}" ><b>Login Link</b></a>

                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->


@endsection

@section('addjs')

            <script src="{{asset('backend/assets/libs/cleave.js/addons/cleave-phone.ve.js')}}"></script>
            <script src="{{asset('backend/assets/libs/cleave.js/cleave.min.js')}}"></script>
            <script src="{{asset('backend/assets/js/pages/form-masks.init.js')}}"></script>


    {!!  GoogleReCaptchaV2::render('recaptcha_form_register') !!}
@endsection

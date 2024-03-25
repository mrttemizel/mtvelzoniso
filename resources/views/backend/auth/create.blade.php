@extends('backend.components.master-withoutnavbar')
@section('title')
    Create
@endsection
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

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row mt-5 text-white justify-content-center">
                    <h3 class="text-white text-center">Sağlık Bilimleri Girişimsel Olmayan Araştırmalar Etik Kurulu Başvuru Sayfası
                    </h3>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-2">

                            <div class="card-body p-4 mt-2">
                                <div class="text-center mt-2">
                                    <img src="{{ asset('backend/my-image/abu-renkli.svg') }}" alt="" height="60">
                                    <h5 class="text-primary mt-4">Hoş Geldiniz !</h5>
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

                                @if (session()->get('success'))
                                    <div
                                        class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show"
                                        role="alert">
                                        <i class="ri-check-double-line label-icon"></i><strong>
                                            {{ session()->get('success') }}</strong></strong>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endif


                                <div class="p-2">
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
                                            <button class="btn btn-info w-100" id="kayit_ol_button" type="submit">Kayıt Ol</button>
                                        </div>

                                    </form>
                                    <div class="mt-3 text-center">
                                        Hesabın var mı?
                                        <a class="text-primary" href="{{route('auth.login')}}" ><b>Giriş Yap</b></a>

                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                    </div>
                </div>
                <div class="row  text-white justify-content-center">

                    <h5 class="text-center">
                        Antalya Bilim Üniversitesi Girişimsel Olmayan Araştırmalar Etik Kurulu Yönergesi ABÜ Senatosu’nun 05.04.2022 tarih ve 05 sayılı toplantısında alınan karar ile kabul edilmiş olup üyelerin 08.04.2022 tarihi itibarı ile atanmaları sonrasında çalışmalarına başlamıştır. Türkiye İlaç ve Tıbbi Cihaz Kurumundan 13/04/2014 tarih ve 28617 sayılı İlaç ve Biyolojik Ürünlerin Klinik Araştırmaları Hakkında Yönetmelik (Klinik İlaç Araştırmaları, Tıbbi Cihaz Araştırmaları vb.) kapsamı dışında kalan Yönetmelik Dışı Klinik Araştırmalar ABÜ Girişimsel Olmayan Araştırmalar Etik Kurulunda değerlendirilecektir.
                    </h5>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->


    </div>
    <!-- end auth-page-wrapper -->

@endsection

@section('addjs')

    <script src="{{asset('backend/assets/libs/cleave.js/addons/cleave-phone.ve.js')}}"></script>
    <script src="{{asset('backend/assets/libs/cleave.js/cleave.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/pages/form-masks.init.js')}}"></script>


    <script>
        $(document).on('click', '#kayit_ol_button', function () {
            $('#kayit_ol_button').html('Kayıt Yapılıyor...');
            $('#kayit_ol_button').addClass("disabled");
        });
    </script>

    {!!  GoogleReCaptchaV2::render('recaptcha_form_register') !!}
@endsection

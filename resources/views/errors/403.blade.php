@extends('backend.layouts.master-withoutnavbar')

@push('site_title', trans('auth.unauthorized'))

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
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <div class="text-center pt-4">
                            <img src="{{ asset('backend/my-image/abu-beyaz.svg') }}" alt=""
                                 class="error-basic-img move-animation" />

                            <h3 class="text-uppercase text-white">{{ trans('auth.unauthorized') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script>
                                Antalya Bilim Üniversitesi <i class="mdi mdi-heart text-danger"></i> MPANEL
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

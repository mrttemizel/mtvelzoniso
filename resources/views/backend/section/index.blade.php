@extends('backend.layouts.master')
@section('title')
    Kullanıcı Ekle
@endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @component('backend.layouts.breadcrumb')
        @slot('li_1')
            Kullanıcılar
        @endslot
        @slot('title')
            Kullanıcı Ekle
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-6">
            @if (session()->get('success'))
                <div class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show"
                     role="alert" id="alert-message">
                    <i class="ri-check-double-line label-icon"></i><strong>  {{ session()->get('success') }}</strong></strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif
            @if (session()->get('error'))
                <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show"
                     role="alert">
                    <i class="ri-check-double-line label-icon"></i><strong>  {{ session()->get('success') }}</strong></strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Bölüm Ekle</h4>

                </div><!-- end card header -->
                <form action="{{route('sections.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-3">

                                <div>
                                    <label for="basiInput" class="form-label"><span
                                                class="text-danger">*</span> Bölüm Adı: </label>
                                    <input type="text" name="section_name" placeholder="Bölüm Adı" class="form-control"
                                           value="{{ old('section_name') }}">
                                    <span class="text-danger">
                                    @error('section_name')
                                        {{ $message }}
                                        @enderror
                            </span>
                                </div>

                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Ekle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Bölümleri Listele</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-3">
                            <!-- Striped Rows -->
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Bölüm Adı</th>
                                    <th scope="col">Düzenle</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $datas)
                                    <tr>

                                        <td>{{$datas->section_name}}</td>
                                        <td><a href="javascript:void(0)"
                                               data-url={{route('sections.delete', ['id'=>$datas->id]) }} data-id={{ $datas->id }} class="link-danger"
                                               id="delete_section"><i class="ri-delete-bin-5-line"></i></a></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
    </div>
    </div>

@endsection



@section('addjs')
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/sweetalerts.init.js') }}"></script>
    <script src="{{asset('backend/assets/libs/cleave.js/addons/cleave-phone.ve.js')}}"></script>
    <script src="{{asset('backend/assets/libs/cleave.js/cleave.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/pages/form-masks.init.js')}}"></script>
    <script>
        $(document).on('click', '#delete_section', function () {
            var section_id = $(this).attr('data-id');
            const url = $(this).attr('data-url');
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu kullanıcıyı silmek istediğinize emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: 'Vazgeç'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });

        setTimeout(function () {
            $("div.alert").remove();
        }, 2000); // 2 secs


    </script>
@endsection

@extends('backend.components.master')
@section('title') Dashboard  @endsection
@section('css')
    <style>
        #degerlendirme_bekleyen_page{
            cursor: pointer;
        }
        #on_kabul_page{
            cursor: pointer;
        }
        #resmi_kabul_page{
            cursor: pointer;
        }
        #tum_basvurular_page{
            cursor: pointer;
        }
    </style>

@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1') Admin @endslot
        @slot('title') Dashboard  @endslot
    @endcomponent




            <div class="row">

                <div class="col-lg-6" id="degerlendirme_bekleyen_page">
                    <!-- card -->
                    <div class="card card-animate bg-info bg-gradient ">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="fw-medium text-white mb-0">Değerlendirmeyi Bekleyen Başvurular :</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4" >
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white" id="degerlendirme_bekleyen"></h4>

                                </div>

                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->






                <div class="col-lg-6" id="on_kabul_page">
                    <!-- card -->
                    <div class="card card-animate  bg-gradient  bg-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="fw-medium text-white mb-0">Ön Kabul Almış Ödeme Yapmayı Bekleyen Başvurular :</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4" >
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white" id="on_kabul"></h4>

                                </div>

                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-lg-6" id="resmi_kabul_page">
                    <!-- card -->
                    <div class="card card-animate bg-gradient bg-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="fw-medium text-white mb-0">Resmi Kabul Almış Kayda Dönmesini Bekleyen Başvurular :</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4" >
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white" id="resmi_kabul"></h4>

                                </div>

                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->



                <div class="col-lg-6" id="tum_basvurular_page">
                    <!-- card -->
                    <div class="card card-animate  bg-gradient  bg-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class=" fw-medium text-white mb-0">Tüm Başvurular Sayısı :</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4" >

                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white" id="toplam_basvuru"></h4>

                                </div>

                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>



@endsection

@section('addjs')

    <script>
        $(document).ready(function() {

            $("#degerlendirme_bekleyen_page").click(function(){
                window.location.href = "{{ route('basvurular.degerlendirmeyi_bekleyenler') }}";
            });
            $("#on_kabul_page").click(function(){
                window.location.href = "{{ route('basvurular.on_kabul_almislar') }}";
            });

   $("#resmi_kabul_page").click(function(){
                window.location.href = "{{ route('basvurular.resmi_kabul_almislar') }}";
            });
   $("#tum_basvurular_page").click(function(){
                window.location.href = "{{ route('basvurular.tum_basvurular') }}";
            });


            $.ajax({
                url: '/api/form-degerlendirme',
                method: 'GET',
                success: function(response) {
                    var totalCount_degerlendirme  = response.total;
                    $('#degerlendirme_bekleyen').html(totalCount_degerlendirme);
                }
            });
            $.ajax({
                url: '/api/form_resmi_kabul',
                method: 'GET',
                success: function(response) {
                    var totalCount_resmi_kabul  = response.total;
                    $('#resmi_kabul').html(totalCount_resmi_kabul);
                }
            });

            $.ajax({
                url: '/api/form-toplam',
                method: 'GET',
                success: function(response) {
                    var totalCount  = response.total;
                    $('#toplam_basvuru').html(totalCount);
                }
            });
            $.ajax({
                url: '/api/form-onkabul',
                method: 'GET',
                success: function(response) {
                    var total_onkabul  = response.total;
                    $('#on_kabul').html(total_onkabul);
                }
            });
        });


    </script>
@endsection

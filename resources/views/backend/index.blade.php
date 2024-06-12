@extends('backend.components.master')

@push('title', 'Dashboard')

@push('css')
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
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <a href="#" class="col-lg-6" id="degerlendirme_bekleyen_page">
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
                </div>
            </div>
        </a>

        <a href="#" class="col-lg-6" id="on_kabul_page">
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
                </div>
            </div>
        </a>

        <a href="#" class="col-lg-6" id="resmi_kabul_page">
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
                </div>
            </div>
        </a>

        <a href="#" class="col-lg-6" id="tum_basvurular_page">
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
                </div>
            </div>
        </a>
    </div>
@endsection

@push('javascript')
    <script>
        $(document).ready(function() {
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
@endpush

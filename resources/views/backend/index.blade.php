@extends('backend.components.master')
@section('title') Dashboard  @endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1') Admin @endslot
        @slot('title') Dashboard  @endslot
    @endcomponent


        <div class="row">

            <div class="row">
                <div class="col-lg-4">
                    <!-- card -->
                    <div class="card card-animate bg-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-white mb-0">Toplam Başvuru Sayısı :</p>
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

                <div class="col-lg-4">
                    <!-- card -->
                    <div class="card card-animate bg-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-white mb-0">On Kabul Mektubu Gonderilenlerin Sayısı :</p>
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

            </div>


        </div>
@endsection

@section('addjs')

    <script>
        $(document).ready(function() {
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

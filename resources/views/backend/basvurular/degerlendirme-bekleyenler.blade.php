@extends('backend.components.master')
@section('title')
    Applications
@endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Başvurular
        @endslot
        @slot('title')
            Değerlendirmeyi Bekleyen Başvurular
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            @if (session()->get('success'))
                <div class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show"
                     role="alert">
                    <i class="ri-check-double-line label-icon"></i><strong>  {{ session()->get('success') }}</strong></strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif
            @if (session()->get('error'))
                <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show"
                     role="alert">
                    <i class="ri-check-double-line label-icon"></i><strong>  {{ session()->get('error') }}</strong></strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0"> Değerlendirmeyi Bekleyen Başvurular</h5>
                            <a href="{{ route('auth.index') }}" class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i class="ri-arrow-go-back-fill"></i> &nbsp; Geri Dön</a>

                        </div>
                        <div class="card-body">
                            <table id="alternative-pagination"
                                   class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>

                                        Agency Code

                                    </th>
                                    <th>Application Status</th>
                                    <th>Application No.</th>
                                    <th>Application Date</th>
                                    <th>Name Surname</th>
                                    <th>Preference Section</th>


                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody
                                @php $i = 0 @endphp
                                @foreach($data as $datas)
                                    @php $i++ @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>

                                            {{$datas->agency_code }}

                                        </td>
                                        <td>
                                            @if($datas -> application_status == 1)
                                                <span class="badge bg-warning">Waiting For Evaluation</span>
                                            @elseif($datas -> application_status == 2)
                                                <span class="badge bg-info">Pre - Acceptance</span>
                                            @elseif($datas -> application_status == 3)
                                                <span class="badge bg-primary">Official Acceptance</span>
                                            @elseif($datas -> application_status == 4)
                                                <span class="badge bg-danger">Rejected</span>
                                            @elseif($datas -> application_status == 5)
                                                <span class="badge bg-secondary">Missing Document</span>
                                            @elseif($datas -> application_status == 6)
                                                <span class="badge bg-success">Registration Completed</span>
                                            @endif
                                        </td>
                                        <td>{{$datas->basvuru_id}}</td>
                                        <td>{{$datas->created_at->format('d-m-Y')}}</td>
                                        <td>{{$datas->name_surname}}</td>
                                        <td>{{$datas->getSectionOne->section_name}}</td>

                                        <td>
                                            <div class="hstack gap-3 fs-15">

                                                <a href="javascript:void(0)" class="btn btn-success btn-sm"
                                                   data-bs-toggle="modal" data-bs-target="#formDetailsModal"
                                                   id="show_form_details" data-id={{ $datas->id }}><i
                                                        class=" ri-eye-fill"></i></a>

                                                    <a href="{{route('form.edit', ['id' => $datas->id])}}"
                                                       class="btn btn-primary btn-sm"><i class="ri-settings-4-line"></i></a>
                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                                       data-url="{{route('form.delete', ['id'=>$datas->id]) }}"
                                                       data-id="{{ $datas->id }}" id="delete_form"><i
                                                            class="ri-delete-bin-5-line"></i></a>

                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>

    <!-- Default Modals -->

    @include('backend.form.form-details-modal')
@endsection

@section('addjs')
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/sweetalerts.init.js') }}"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('backend/assets/js/pages/datatables.init.js')}}"></script>


    <script>
        $(document).on('click', '#show_form_details', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: 'GET',
                url: '/see/' + id, // Veri çekmek için oluşturduğumuz route'a istek gönder
                success: function (response) {
                    $('#formDetailsModal .modal-body').html(response); // Modal içeriğini güncelle
                },
            });
        });

    </script>


    <script>
        $(document).on('click', '#delete_form', function () {
            var user_id = $(this).attr('data-id');
            const url = $(this).attr('data-url');
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu başvuruyu silmek istediğinize emin misiniz?",
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

    </script>

@endsection


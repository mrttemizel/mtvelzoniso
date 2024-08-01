@extends('backend.layouts.master')

@push('site_title', trans('department.titles.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatable/css/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatable/css/responsive.bootstrap.min.css') }}" />
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('department.titles.index') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard.index') }}">{{ trans('sidebar.dashboard') }}</a>
                        </li>

                        <li class="breadcrumb-item active">{{ trans('department.titles.index') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3 d-flex justify-content-end">
                            <a href="{{ route('backend.departments.create') }}" class="btn btn-block btn-info d-flex align-items-center">
                                <i class="bx bx-plus mr-2"></i>
                                <span class="d-block">{{ trans('department.buttons.create') }}</span>
                            </a>
                        </div>

                        <div class="col-12">
                            <div class="table-responsive-sm">
                                <table id="table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('department.tables.id') }}</th>
                                            <th>{{ trans('department.tables.faculty') }}</th>
                                            <th>{{ trans('department.tables.name') }}</th>
                                            <th>{{ trans('department.tables.annual_fee') }}</th>
                                            <th>{{ trans('department.tables.discounted_fee') }}</th>
                                            <th>{{ trans('department.tables.status') }}</th>
                                            <th>{{ trans('department.tables.actions') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="{{ asset('backend/assets/vendor/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/datatable/js/dataTables.responsive.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            const body = $(this);

            const dt = body.find("#table").DataTable({
                searching: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('backend.departments.dataTable') }}"
                },
                columns: [
                    { data: 'id', name: 'id', searchable: false },
                    { data: 'faculty', name: 'faculty' },
                    { data: 'name', name: 'name' },
                    { data: 'annual_fee', name: 'annual_fee' },
                    { data: 'discounted_fee', name: 'discounted_fee' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: 'actions', searchable: false, orderable: false }
                ]
            });
        });
    </script>
@endpush

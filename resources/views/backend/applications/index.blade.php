@extends('backend.layouts.master')

@push('site_title', trans('application.titles.index'))

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatable/css/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/datatable/css/responsive.bootstrap.min.css') }}" />
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('application.titles.index') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard.index') }}">{{ trans('sidebar.applications.index') }}</a>
                        </li>

                        <li class="breadcrumb-item active">{{ trans('application.titles.index') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if (auth()->user()->isAuthorized())
            <div class="col-12">
                <div class="row d-flex justify-content-between">
                    <div class="col-12 col-md-2">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-block">
                                    <div>
                                        <p class="fw-medium text-muted text-center mb-0">{{ trans('application.texts.pending-application') }}</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value pending_application" data-target="">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-block">
                                    <div>
                                        <p class="fw-medium text-muted text-center mb-0">{{ trans('application.texts.sent-pre-letter') }}</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value sent_pre_letter" data-target="">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-block">
                                    <div>
                                        <p class="fw-medium text-muted text-center mb-0">{{ trans('application.texts.pending-payment-application') }}</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value pending_payment" data-target="">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-block">
                                    <div>
                                        <p class="fw-medium text-muted text-center mb-0">{{ trans('application.texts.sent-official-letter') }}</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value sent_official_letter" data-target="">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-block">
                                    <div>
                                        <p class="fw-medium text-muted text-center mb-0">{{ trans('application.texts.missing-document') }}</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value missing_document" data-target="">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="POST" id="applicationFilterForm">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="status">{{ trans('application.inputs.status') }}</label>
                                        <select name="status" class="form-control">
                                            <option value="" selected>{{ trans('application.inputs.status') }}</option>
                                            @foreach (\App\Enums\ApplicationStatusEnum::array() as $value => $key)
                                                <option value="{{ $value }}">{{ trans('application.statuses.' . str($value)->replace('.', '-')) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="status">{{ trans('application.inputs.academic_year_id') }}</label>
                                        <select name="academic_year_id" class="form-control">
                                            <option value="" selected>{{ trans('application.inputs.academic_year_id') }}</option>
                                            @foreach (academicYears(true) as $academicYear)
                                                <option value="{{ $academicYear->id }}">{{ $academicYear->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @if (auth()->user()->isAllAdmin())
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="status">{{ trans('application.inputs.agency_id') }}</label>
                                            <select name="agency_id" class="form-control">
                                                <option value="" selected>{{ trans('application.inputs.agency_id') }}</option>
                                                <option value="self">{{ trans('application.texts.self-application') }}</option>
                                                @foreach (agencies() as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->code }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3 justify-content-end d-flex">
                                    <button type="submit" class="btn btn-primary mr-5">{{ trans('application.buttons.apply') }}</button>
                                    <button type="reset" class="btn btn-danger">{{ trans('application.buttons.reset') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3 d-flex justify-content-between">
                            <a href="#" class="btn btn-warning btn-export">
                                <i class="bx bx-download"></i>
                                {{ trans('application.buttons.export') }}
                            </a>

                            <a href="{{ route('backend.applications.create') }}" class="btn btn-block btn-info d-flex align-items-center">
                                <i class="bx bx-plus mr-2"></i>
                                <span class="d-block">{{ trans('application.buttons.create') }}</span>
                            </a>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive-sm">
                                <table id="table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('application.tables.id') }}</th>
                                            @if (auth()->user()->isAllAdmin())
                                                <th>{{ trans('application.tables.agency_code') }}</th>
                                                <th>{{ trans('application.tables.agency_name') }}</th>
                                            @endif
                                            <th>{{ trans('application.tables.name') }}</th>
                                            @if (auth()->user()->isAllAdmin())
                                                <th>{{ trans('application.tables.payment_file_at') }}</th>
                                            @endif
                                            <th>{{ trans('application.tables.status') }}</th>
                                            <th>{{ trans('application.tables.actions') }}</th>
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

    <div class="modal modal-lg fade" id="missingDocumentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('backend.applications.update-status') }}" method="POST">
                    @csrf

                    <input type="hidden" name="status" value="{{ \App\Enums\ApplicationStatusEnum::MISSING_DOCUMENT->value }}" />
                    <input type="hidden" name="id" value="" />

                    <div class="modal-header">
                        <h5 class="modal-title">{{ trans('application.texts.missing-document-header') }}</h5>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label>{{ trans('application.inputs.description') }}</label>
                                    <input type="text" name="description" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('application.buttons.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('application.buttons.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modal-lg fade" id="uploadPaymentDocumentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('backend.applications.upload-payment') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="" />

                    <div class="modal-header">
                        <h5 class="modal-title">{{ trans('application.texts.upload-payment-document') }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label>{{ trans('application.inputs.payment-document') }}</label>
                                    <input type="file" name="file" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('application.buttons.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('application.buttons.upload') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modal-lg fade" id="sendOfficialLetterModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('backend.applications.update-status') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="status" value="{{ \App\Enums\ApplicationStatusEnum::OFFICIAL_LETTER_SENT->value }}" />
                    <input type="hidden" name="id" value="" />

                    <div class="modal-header">
                        <h5 class="modal-title">{{ trans('application.texts.upload-letter') }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label>{{ trans('application.inputs.attachments') }}</label>
                                    <input type="file" name="attachments[]" class="form-control" multiple />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('application.buttons.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('application.buttons.send-mail') }}</button>
                    </div>
                </form>
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

            body.on('click', '.btn-export', function (e) {
                e.preventDefault();
                let form = body.find('#applicationFilterForm');
                let data = {
                    status: form.find('select[name="status"] option:selected').val(),
                    agency: form.find('select[name="agency_id"] option:selected').val()
                };

                let url = new URL('{{ route('backend.applications.export') }}');

                url.searchParams.set('status', data.status);
                url.searchParams.set('agency', data.agency);

                window.open(url.toString(), '_blank');
            });

            body.on('click', '.btn-upload-payment', function (e) {
                e.preventDefault();
                let btn = $(this);

                let modal = body.find('#uploadPaymentDocumentModal');
                let form = modal.find('form');

                form.find('input[name="id"]').val(btn.attr('data-id'));

                modal.modal('show');
            });

            body.on('click', '.btn-missing-document', function (e) {
                let btn = $(this);
                let modal = body.find('#missingDocumentModal');
                let form = modal.find('form');

                form.find('input[name="id"]').val(btn.attr('data-id'));

                modal.modal('show');
            });

            body.on('click', '.btn-sent-letter', function (e) {
                let btn = $(this);
                let modal = body.find('#sendOfficialLetterModal');
                let form = modal.find('form');

                form.find('input[name="id"]').val(btn.attr('data-id'));

                modal.modal('show');
            });

            $.ajax({
                method: 'GET',
                url: '{{ route('backend.applications.get-columns') }}',
                success: function (response) {
                    const dt = body.find("#table").DataTable({
                        searching: false,
                        processing: true,
                        serverSide: true,
                        order: [[0, 'desc']],
                        ajax: {
                            url: "{{ route('backend.applications.dataTable') }}",
                            data: function (item) {
                                let form = body.find('#applicationFilterForm');
                                item.status = form.find('select[name="status"] option:selected').val();
                                item.agency = form.find('select[name="agency_id"] option:selected').val();

                                return item;
                            }
                        },
                        columns: response.data
                    });

                    body.on('submit', '#applicationFilterForm', function (e) {
                        e.preventDefault();

                        dt.ajax.reload();
                        getStatistics();
                    });

                    body.on('click', '#applicationFilterForm button[type="reset"]', function (e) {
                        let form = body.find('#applicationFilterForm');
                        form.trigger('reset');

                        dt.table().order([]);
                        dt.ajax.reload();
                    });
                }
            });

            getStatistics();

            function getStatistics() {
                let form = body.find('#applicationFilterForm');

                let status = form.find('select[name="status"] option:selected').val();
                let agency = form.find('select[name="agency_id"] option:selected').val();

                $.ajax({
                    method: 'GET',
                    url: '{{ route('backend.applications.statistics') }}',
                    data: {
                        agency_id: agency,
                        status: status
                    },
                    success: function (response) {
                        Object.entries(response.data).forEach(function (item) {
                            body.find(`.${item[0]}`).text(item[1]);
                        });
                    }
                });
            }
        });
    </script>
@endpush

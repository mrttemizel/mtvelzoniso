@extends('backend.layouts.master')

@push('site_title', trans('dashboard.titles.index'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('dashboard.titles.index') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">{{ trans('dashboard.titles.index') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            hello
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush

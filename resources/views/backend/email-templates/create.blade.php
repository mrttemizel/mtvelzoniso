@extends('backend.layouts.master')

@push('site_title', trans('email-template.titles.create'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ trans('email-template.titles.create') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.dashboard.index') }}">{{ trans('sidebar.dashboard') }}</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('backend.email-templates.index') }}">{{ trans('sidebar.email-template') }}</a>
                        </li>

                        <li class="breadcrumb-item active">{{ trans('email-template.titles.create') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('backend.email-templates.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : null }}">
                                    <label for="name">{{ trans('email-template.inputs.title') }}</label>
                                    <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : null }}" value="{{ old('title') }}" />
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group {{ $errors->has('content') ? 'has-error' : null }}">
                                    <label for="name">{{ trans('email-template.inputs.content') }}</label>
                                    <textarea name="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : null }}" cols="30" rows="10">{{ old('content') }}</textarea>
                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback">{{ $errors->first('content') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="row">
                                    @foreach ($statuses as $status)
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <input type="checkbox" name="statuses[]" value="{{ $status }}" id="status{{ $loop->index }}" />
                                                <label for="status{{ $loop->index }}">{{ trans('application.statuses.' . str($status)->replace('.', '-')) }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>{{ trans('email-template.headings.attachments') }}</h4>
                                    </div>

                                    @foreach ($attachments as $attachment)
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <input type="checkbox" name="attachments[]" value="{{ $attachment }}" id="attachment{{ $loop->index }}" />
                                                <label for="attachment{{ $loop->index }}">{{ trans('application.attachments.' . str($attachment)->replace('.', '-')) }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-lg-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bxs-save"></i>
                                    <span>{{ trans('email-template.buttons.save') }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

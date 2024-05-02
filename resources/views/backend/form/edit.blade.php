@extends('backend.components.master')
@section('title')
    New Applications
@endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Applications
        @endslot
        @slot('title')
            Apply & New Applications
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
                    <i class="ri-check-double-line label-icon"></i><strong>  {{ session()->get('success') }}</strong></strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Apply & New Applications</h4>
                    <a href="{{ route('form.index') }}" class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i class="ri-arrow-go-back-fill"></i> &nbsp; Back</a>
                </div><!-- end card header -->
                <div class="card-body">

                    <p class="text-danger">Başvuru Kodu : <b>{{$data->basvuru_id}}</b></p>
                    <p class="text-danger">Acenta Kodu : <b>{{$data->agency_code}}</b></p>
                    @if($data -> application_status == 1)
                        <p class="badge bg-warning">Waiting For Evaluation</p>
                    @elseif($data -> application_status == 2)
                        <p class="badge bg-info">Pre - Acceptance</p>
                    @elseif($data -> application_status == 3)
                        <p class="badge bg-primary">Official Acceptance</p>
                    @elseif($data -> application_status == 4)
                        <p class="badge bg-danger">Rejected</p>
                    @elseif($data -> application_status == 5)
                        <p class="badge bg-secondary">Missing Document</p>
                    @elseif($data -> application_status == 6)
                        <p class="badge bg-success">Registration Completed</p>
                    @endif
                    <form class="application-form" id="application-form" method="POST" action="{{route('form.update')}}"  enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <h6 class="fw-bolder">PERSONAL DETAILS</h6>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label  class="form-label"><span class="text-danger">*</span> Name and Surname</label>
                                    <input type="text" class="form-control" placeholder="Name and Surname" name="name_surname" value="{{$data->name_surname}}">
                                    <span class="text-danger">
                                    @error('name_surname')
                                        {{ $message }}
                                        @enderror
                            </span>
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label  class="form-label"><span class="text-danger">*</span> Nationality</label>
                                    <input type="text" class="form-control" placeholder="Country" name="nationality" value="{{ $data->nationality }}">
                                    <span class="text-danger">
                                    @error('nationality')
                                        {{ $message }}
                                        @enderror
                            </span>
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label  class="form-label"><span class="text-danger">*</span> Passport No</label>
                                    <input type="text" class="form-control" placeholder="Passport No" name="passport_no" value="{{ $data->passport_no }}" >
                                    <span class="text-danger">
                                    @error('passport_no')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label  class="form-label"><span class="text-danger">*</span> Place of Birth</label>
                                    <input type="text" class="form-control" placeholder="Place of Birth" name="place_of_birth" value="{{ $data->place_of_birth }}">
                                    <span class="text-danger">
                                    @error('place_of_birth')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label  class="form-label"><span class="text-danger">*</span> Date of Birth</label>
                                    <input type="date" class="form-control" placeholder="Date of Birth" name="date_of_birth" value="{{ $data->date_of_birth }}">
                                    <span class="text-danger">
                                    @error('date_of_birth')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label  class="form-label"><span class="text-danger">*</span> Passaport Photo</label>

                                    <input type="file" class="form-control" name="passport_photo">
                                    <span class="text-info">The file size you upload must be a maximum of 2MB. Supported formats are jpg, png, jpeg.</span><br>
                                    @if($data->passport_photo == '')
                                        <h6 class="text-danger fw-bolder">Document Not Uploaded</h6>
                                    @else
                                        <a href="{{ asset('form/'.$data->passport_photo) }}" class="btn btn-danger btn-sm" download target="_blank">Yüklü Dosya</a>

                                    @endif
                                    <span class="text-danger">
                                    @error('passport_photo')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->

                            <h6 class="fw-bolder mt-1">CONTACT  DETAILS</h6>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="text-danger">*</span> Country</label>
                                    <input type="text" class="form-control" placeholder="Enter your city" name="country" value="{{ $data->country }}">
                                    <span class="text-danger">
                                    @error('country')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="text-danger">*</span> Adress</label>
                                    <input type="text" class="form-control" placeholder="Enter your city" name="adress" value="{{$data->adress }}">
                                    <span class="text-danger">
                                    @error('adress')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="text-danger">*</span> Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter your city" name="phone_number" value="{{ $data->phone_number }}">
                                    <span class="text-danger">
                                    @error('phone_number')
                                        {{ $message }}
                                        @enderror
                            </span>
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="text-danger">*</span> Email</label>
                                    <input type="email" class="form-control" placeholder="Enter your city" name="email" value="{{ $data->email }}">
                                    <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->

                            <h6 class="fw-bolder mt-4">HIGH SCHOOL INFORMATION</h6>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="text-danger">*</span> High School</label>
                                    <input type="text" class="form-control" placeholder="High School" name="high_school" value="{{ $data->high_school }}">
                                    <span class="text-danger">
                                    @error('high_school')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="text-danger">*</span> High School Country</label>
                                    <input type="text" class="form-control" placeholder="High School Country" name="high_school_country" value="{{ $data->high_school_country }}">
                                    <span class="text-danger">
                                    @error('high_school_country')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="text-danger">*</span>High School City</label>
                                    <input type="text" class="form-control" placeholder="High School City" name="high_school_city" value="{{ $data->high_school_city }}">
                                    <span class="text-danger">
                                    @error('high_school_city')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="text-danger">*</span> Year of Graduation</label>
                                    <input type="date" class="form-control"  name="year_of_graduation" value="{{ $data->year_of_graduation }}">
                                    <span class="text-danger">
                                    @error('year_of_graduation')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="text-danger">*</span> Graduation Degree ( GPA ) </label>
                                    <input type="text" class="form-control"  name="graduation_degree" value="{{ $data->graduation_degree }}">
                                    <span class="text-danger">
                                    @error('graduation_degree')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label"><span class="text-danger">*</span> Official Transcript "Last 3 Years"</label>

                                    <input type="file" class="form-control"  name="official_transcript">
                                    <span class="text-info">The file size you upload must be a maximum of 2MB. Supported formats are pdf, xlsx, docx, doc.</span><br>
                                    @if($data->official_transcript == '')
                                        <h6 class="text-danger fw-bolder">Document Not Uploaded</h6>
                                    @else
                                        <a href="{{ asset('form/'.$data->official_transcript) }}" class="btn btn-danger btn-sm" download target="_blank">Yüklü Dosya</a>
                                    @endif
                                    <span class="text-danger">
                                    @error('official_transcript')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->
                            <h6 class="fw-bolder mt-4">TEST SCORES AND DOCUMENTS</h6>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">If taken before, a copy of language proficiency exam result (e.g. TOEFL etc.)</label>

                                    <input type="file" class="form-control"  name="official_exam">
                                    <span class="text-info">The file size you upload must be a maximum of 2MB. Supported formats are pdf, xlsx, docx, doc.</span><br>
                                    @if($data->official_exam == '')
                                        <h6 class="text-danger fw-bolder">Document Not Uploaded</h6>
                                    @else
                                        <a href="{{ asset('form/'.$data->official_exam) }}"  class="btn btn-danger btn-sm" download target="_blank">Yüklü Dosya</a>
                                    @endif
                                    <span class="text-danger">
                                    @error('official_exam')
                                        {{ $message }}
                                        @enderror
                            </span>
                                </div>
                            </div><!--end col-->

                            <h6 class="fw-bolder mt-4">PROGRAM DETAILS</h6>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label  class="form-label"><span class="text-danger">*</span> Program Preference</label>
                                    <select  class="form-select" name="section_id">
                                        @foreach($section as $sections)
                                            <option value="{{ $sections->id }}" @if($data->section_id == $sections->id) selected @endif>{{ $sections->section_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                    @error('section_id')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->

                            <div class="col-12">
                                <div class="mb-3">
                                    <label  class="form-label">Where did you hear about us? <b>(If you apply via an agency, please write the agency name)</b> </label>
                                    <input type="text" class="form-control"  name="about_us" value="{{ $data->about_us }}">
                                    <span class="text-danger">
                                    @error('about_us')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div>
                            </div><!--end col-->

                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" id="formupdateButton" class="btn btn-primary">Güncelle</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                    <div class="col-lg-12 text-end mt-2">
                        <a href="javascript:void(0)" class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#preliminaryAcceptanceLetter" id="show_form_details"><i class="ri-mail-send-line"></i> Ön Kabul Mektubu Gönder</a>
                    </div>

                </div><!-- end card body -->

            </div>
        </div>
    </div>




@include('backend.form.preliminary-acceptance-letter-modal')

@endsection



@section('addjs')
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/sweetalerts.init.js') }}"></script>

    <script>

        setTimeout(function(){
            $("div.alert").remove();
        }, 1000 ); // 2 secs

        $(document).on('click', '#send-pre-accept', function () {

            let timerInterval;
            Swal.fire({
                title: "Kabul Mektubu Gönderiliyor",
                html: "Lütfen bekleyiniz <b></b> milliseconds.",
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });
        });

    </script>

@endsection

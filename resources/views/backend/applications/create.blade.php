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
                    <a href="{{ route('applications.index') }}" class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i class="ri-arrow-go-back-fill"></i> &nbsp; Back</a>

                </div><!-- end card header -->
                    <div class="card-body">
                        <form class="application-form" id="application-form" method="POST" action="{{route('applications.store')}}"  enctype="multipart/form-data">
                            @csrf
                            <h6 class="fw-bolder">PERSONAL DETAILS</h6>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label  class="form-label"><span class="text-danger">*</span> Name and Surname</label>
                                        <input type="text" class="form-control" placeholder="Name and Surname" name="name_surname" value="{{old('name_surname')}}">
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
                                        <input type="text" class="form-control" placeholder="Country" name="nationality" value="{{ old('nationality') }}">
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
                                        <input type="text" class="form-control" placeholder="Passport No" name="passport_no" value="{{ old('passport_no') }}" >
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
                                        <input type="text" class="form-control" placeholder="Place of Birth" name="place_of_birth" value="{{ old('place_of_birth') }}">
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
                                        <input type="date" class="form-control" placeholder="Date of Birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
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
                                        <input type="file" class="form-control" name="passport_photo" value="{{ old('passport_photo') }}">
                                        <span class="text-danger">
                                    @error('passport_photo')
                                            {{ $message }}
                                            @enderror
                            </span>

                                    </div>
                                </div><!--end col-->

                                <h6 class="fw-bolder mt-4">CONTACT  DETAILS</h6>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="text-danger">*</span> Country</label>
                                        <input type="text" class="form-control" placeholder="Enter your city" name="country" value="{{ old('country') }}">
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
                                        <input type="text" class="form-control" placeholder="Enter your city" name="adress" value="{{ old('adress') }}">
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
                                        <input type="text" class="form-control" placeholder="Enter your city" name="phone_number" value="{{ old('phone_number') }}">
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
                                        <input type="email" class="form-control" placeholder="Enter your city" name="email" value="{{ old('email') }}">
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
                                        <input type="text" class="form-control" placeholder="High School" name="high_school" value="{{ old('high_school') }}">
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
                                        <input type="text" class="form-control" placeholder="High School Country" name="high_school_country" value="{{ old('high_school_country') }}">
                                        <span class="text-danger">
                                    @error('high_school_country')
                                            {{ $message }}
                                            @enderror
                            </span>

                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="text-danger">*</span> City</label>
                                        <input type="text" class="form-control" placeholder="High School City" name="high_school_city" value="{{ old('high_school_city') }}">
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
                                        <input type="date" class="form-control"  name="year_of_graduation" value="{{ old('year_of_graduation') }}">
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
                                        <input type="text" class="form-control"  name="graduation_degree" value="{{ old('graduation_degree') }}">
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
                                        <input type="file" class="form-control"  name="official_transcript" value="{{ old('official_transcript') }}">
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
                                        <input type="file" class="form-control"  name="official_exam" value="{{ old('official_exam') }}">
                                    </div>
                                </div><!--end col-->

                                <h6 class="fw-bolder mt-4">PROGRAM DETAILS</h6>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label  class="form-label"><span class="text-danger">*</span> Program Preference</label>
                                        <select  class="form-select" name="section_id">
                                            @foreach( $data as $datas)
                                                <option value="{{$datas -> id}}">{{$datas -> section_name}}</option>
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
                                        <input type="text" class="form-control"  name="about_us" value="{{ old('about_us') }}">
                                        <span class="text-danger">
                                    @error('about_us')
                                            {{ $message }}
                                            @enderror
                            </span>

                                    </div>
                                </div><!--end col-->

                                <h6 class="fw-bolder mt-4">APPLICATION STATUS</h6>


                                <div class="col-12">
                                    <div class="form-check form-switch form-switch-danger">
                                        <input class="form-check-input" type="checkbox" role="switch" name="checkbox_application_status" id="SwitchCheck5" checked>
                                        <label class="form-check-label" for="SwitchCheck5">
                                            I Confirm that, <br>
                                            1. I will bring all required documents for the final registration.<br>
                                            2. If I don't get equivalency from the Ministry of Education in Turkey the University won't take any responsibility and can cancel the registration.<br>
                                            3. I will require my deposit fees only in case of visa rejection confirmed from the embassy.<br>
                                            4. Tuition fees are non-refundable.<br>
                                        </label>
                                    </div>
                                    <span class="text-danger">
                                    @error('checkbox_application_status')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div><!--end col-->

                                <div class="col-12">
                                    <div class="form-check form-switch form-switch-danger">
                                        <input class="form-check-input" type="checkbox" role="switch" name="checkbox_kvkk" id="SwitchCheck5" checked>
                                        <label class="form-check-label" for="SwitchCheck5">
                                            <a href="https://antalya.edu.tr/tr/kvkk-aydinlatma-metni">I approve and consent to the processing of my personal data in the ways specified in the text.</a><br>
                                        </label>
                                    </div>
                                    <span class="text-danger">
                                    @error('checkbox_kvkk')
                                        {{ $message }}
                                        @enderror
                            </span>

                                </div><!--end col-->

                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" id="form_submit_button" class="btn btn-primary">Submit</button>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </form>
                    </div><!-- end card body -->

            </div>
        </div>
    </div>






@endsection



@section('addjs')

    <script>

        setTimeout(function(){
            $("div.alert").remove();
        }, 1000 ); // 2 secs


    </script>

@endsection

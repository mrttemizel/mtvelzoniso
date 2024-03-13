@extends('backend.components.master-withoutnavbar')
@section('title') Application Form  @endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-5">
                    <div class="card-header text-center mt-2">
                        <img src="{{ asset('backend/my-image/abu-renkli.svg') }}" alt="" height="60">
                        <h5 class="text-primary mt-4">Undergraduate Application Form</h5>
                    </div>
                    <div class="card-body">

                        <form class="application-form" id="application-form" method="POST" action="{{route('form.store')}}"  enctype="multipart/form-data">
                            @csrf
                           <h6 class="fw-bolder">PERSONAL DETAILS</h6>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label  class="form-label"><span class="text-danger">*</span> Name and Surname</label>
                                        <input type="text" class="form-control" placeholder="Name and Surname" name="name_surname">
                                        <span class="text-danger error_text name_surname_error"></span>
                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label  class="form-label"><span class="text-danger">*</span> Nationality</label>
                                        <input type="text" class="form-control" placeholder="Country" name="nationality">
                                        <span class="text-danger error_text nationality_error"></span>
                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label  class="form-label"><span class="text-danger">*</span> Passport No</label>
                                        <input type="text" class="form-control" placeholder="Passport No" name="passport_no">
                                        <span class="text-danger error_text passport_no_error"></span>

                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label  class="form-label"><span class="text-danger">*</span> Place of Birth</label>
                                        <input type="text" class="form-control" placeholder="Place of Birth" name="place_of_birth">
                                        <span class="text-danger error_text place_of_birth_error"></span>

                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label  class="form-label"><span class="text-danger">*</span> Date of Birth</label>
                                        <input type="date" class="form-control" placeholder="Date of Birth" name="date_of_birth">
                                        <span class="text-danger error_text date_of_birth_error"></span>

                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label  class="form-label"><span class="text-danger">*</span> Passaport Photo</label>
                                        <input type="file" class="form-control" name="passport_photo">
                                        <span class="text-danger error_text passport_photo_error"></span>

                                    </div>
                                </div><!--end col-->

                                <h6 class="fw-bolder mt-4">CONTACT  DETAILS</h6>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="text-danger">*</span> Country</label>
                                        <input type="text" class="form-control" placeholder="Enter your city" name="country">
                                        <span class="text-danger error_text country_error"></span>

                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="text-danger">*</span> Adress</label>
                                        <input type="text" class="form-control" placeholder="Enter your city" name="adress">
                                        <span class="text-danger error_text adress_error"></span>

                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="text-danger">*</span> Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Enter your city" name="phone_number">
                                        <span class="text-danger error_text phone_number_error"></span>

                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="text-danger">*</span> Email</label>
                                        <input type="email" class="form-control" placeholder="Enter your city" name="email">
                                        <span class="text-danger error_text email_error"></span>

                                    </div>
                                </div><!--end col-->

                                <h6 class="fw-bolder mt-4">HIGH SCHOOL INFORMATION</h6>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="text-danger">*</span> High School</label>
                                        <input type="text" class="form-control" placeholder="High School" name="high_school">
                                        <span class="text-danger error_text high_school_error"></span>

                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="text-danger">*</span> High School Country</label>
                                        <input type="text" class="form-control" placeholder="High School Country" name="high_school_country">
                                        <span class="text-danger error_text high_school_country_error"></span>

                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="text-danger">*</span> City</label>
                                        <input type="text" class="form-control" placeholder="High School City" name="high_school_city">
                                        <span class="text-danger error_text high_school_city_error"></span>

                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="text-danger">*</span> Year of Graduation</label>
                                        <input type="date" class="form-control"  name="year_of_graduation">
                                        <span class="text-danger error_text year_of_graduation_error"></span>

                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="text-danger">*</span> Graduation Degree ( GPA ) </label>
                                        <input type="text" class="form-control"  name="graduation_degree">
                                        <span class="text-danger error_text graduation_degree_error"></span>

                                    </div>
                                </div><!--end col-->
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label"><span class="text-danger">*</span> Official Transcript "Last 3 Years"</label>
                                        <input type="file" class="form-control"  name="official_transcript">
                                        <span class="text-danger error_text official_transcript_error"></span>

                                    </div>
                                </div><!--end col-->
                                <h6 class="fw-bolder mt-4">TEST SCORES AND DOCUMENTS</h6>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">If taken before, a copy of language proficiency exam result (e.g. TOEFL etc.)</label>
                                        <input type="file" class="form-control"  name="official_exam">
                                    </div>
                                </div><!--end col-->

                                <h6 class="fw-bolder mt-4">PROGRAM DETAILS</h6>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label  class="form-label"><span class="text-danger">*</span> Program Preference</label>
                                        <select  class="form-select" name="preference_one">
                                            @foreach( $data as $datas)
                                                <option value="{{$datas -> id}}">{{$datas -> section_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error_text preference_one_error"></span>

                                    </div>
                                </div><!--end col-->

                                <h6 class="fw-bolder mt-4">APPLICATION STATUS</h6>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="inlineFormCheck" name="checkbox_application_status">
                                                <label class="form-check-label" for="inlineFormCheck">
                                                    I Confirm that, <br>
                                                    1. I will bring all required documents for the final registration.<br>
                                                    2. If I don't get equivalency from the Ministry of Education in Turkey the University won't take any responsibility and can cancel the registration.<br>
                                                    3. I will require my deposit fees only in case of visa rejection confirmed from the embassy.<br>
                                                    4. Tuition fees are non-refundable.<br>
                                                </label>
                                            </div>
                                            <span class="text-danger error_text checkbox_application_status_error"></span>

                                        </div><!--end col-->
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="inlineFormCheck2" name="checkbox_kvkk">
                                                <label class="form-check-label" for="inlineFormCheck2">
                                                    <a href="https://antalya.edu.tr/tr/kvkk-aydinlatma-metni">I approve and consent to the processing of my personal data in the ways specified in the text.</a><br>
                                                </label>
                                            </div>
                                            <span class="text-danger error_text checkbox_kvkk_error"></span>

                                        </div><!--end col-->

                                <div class="mt-3">

                                    <div id="recaptcha_form"></div>
                                    <span class="text-danger error_text g-recaptcha-response_error"></span>


                                </div>
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <button type="submit" id="form_submit_button" class="btn btn-primary">Submit</button>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('addjs')
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/sweetalerts.init.js') }}"></script>
        {!!  GoogleReCaptchaV2::render('recaptcha_form') !!}




        <script>


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#application-form').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                $('#form_submit_button').html('Being Sent...').prop('disabled', true)

                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function () {
                        $(form).find('span.error-text').text('');
                    },
                    success: function (data) {
                        if (data.code == 0) {
                            $('#form_submit_button').html('Submit').prop('disabled', false)
                            $.each(data.error, function (prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });

                        } else if (data.code == 1) {
                            Swal.fire({
                                imageUrl: "https://www.antalya.edu.tr/uploads/sub/logo-antalya-bilim-universitesi-tr.png",
                                title: "Successful",
                                text: data.success,
                                icon: "success",
                                confirmButtonColor: '#364574',
                                imageWidth: 300,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        }
                    }
                });

            });

        </script>
@endsection

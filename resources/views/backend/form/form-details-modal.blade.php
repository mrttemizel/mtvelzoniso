<div id="formDetailsModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Applications İnformation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="fs-15">
                    <!-- Striped Rows -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Data</th>
                        </thead>
                        <tbody>
                        @foreach($data as $datas)
                            <tr>
                                <td class="text-danger">Name and Surname</td>
                                <td>{{$datas->name_surname}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">Nationality</td>
                                <td>{{$datas->nationality}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">Passport No</td>
                                <td>{{$datas->passport_no}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">Place of Birth</td>
                                <td>{{$datas->place_of_birth}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">Date of Birth</td>
                                <td>{{$datas->date_of_birth}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">Passaport Photo</td>
                                <td>
                                <a href="{{ asset('form/'.$datas->passport_photo) }}" download target="_blank">Download Photo</a>
                                </td></tr>
                            <tr>
                                <td class="text-danger">Country</td>
                                <td>{{$datas->country}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">Adress</td>
                                <td>{{$datas->adress}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">Phone</td>
                                <td>{{$datas->phone_number}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">Email</td>
                                <td>{{$datas->email}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">High School</td>
                                <td>{{$datas->high_school}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">High School Country</td>
                                <td>{{$datas->high_school_country}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">High School City</td>
                                <td>{{$datas->high_school_city}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">Year of Graduation</td>
                                <td>{{$datas->year_of_graduation}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">Graduation Degree ( GPA )</td>
                                <td>{{$datas->graduation_degree}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">Official Transcript "Last 3 Years"</td>
                                @if($datas->official_transcript == '')
                                    <td> Document Not Uploaded</td>
                                @else
                                    <td><a href="{{ asset('form/'.$datas->official_transcript) }}" download target="_blank">Download File</a></td>
                                @endif

                            </tr>
                            <tr>
                                <td class="text-danger">Exam(TOEFL vb)</td>
                                @if($datas->official_exam == '')
                                    <td> Document Not Uploaded</td>
                                @else
                                <td><a href="{{ asset('form/'.$datas->official_exam) }}" download target="_blank">Download File</a></td>
                                @endif
                            </tr>
                            <tr>
                                <td class="text-danger">Program Preference</td>
                                <td>{{$datas->getSectionOne->section_name}}</td>
                            </tr>
                            <tr>
                                <td class="text-danger">Abouth Us</td>
                                <td>{{$datas->about_us}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </h5>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <div id="preliminaryAcceptanceLetter" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
         style="display: none;">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Ön Kabul Mektubu Gönder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="fs-15">
                        <!-- Striped Rows -->
                        Başvuru ID : <b>{{$data->basvuru_id}}</b>
                    </h5>
                    <form action="{{route('letter.send-pre-letter')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="basvuru_id" value="{{$data->basvuru_id}}">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label"><span class="text-danger">*</span> Kabul Mektubu Ekle</label>

                                <input type="file" class="form-control"  name="preliminary_acceptance_letter">
                                <span class="text-info">Yükleyeceğiniz dosya boyutu maksimum 2MB olmalıdır. Desteklenen formatlar pdf, xlsx, docx, doc.</span><br>
                                <span class="text-danger">
                                    @error('preliminary_acceptance_letter')
                                    {{ $message }}
                                    @enderror
                            </span>

                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12 mt-3">
                            <div class="text-end">
                                <button type="submit" id="send-pre-accept" class="btn btn-primary">Gönder</button>
                            </div>
                        </div><!--end col-->
                    </form>

                </div>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

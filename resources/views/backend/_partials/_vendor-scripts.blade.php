<script src="{{ asset('backend/assets/js/layout.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery-3.7.0.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('backend/assets/libs/toastify-js/toastr.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/toastify-js/toastify-js.js') }}"></script>
<script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/daterangepicker/daterangepicker.min.js') }}"></script>

<script src="{{asset('backend/assets/js/app.js')}}"></script>

<script>
    @if (session()->has('alert-message'))
        toastr.options.positionClass = 'toast-top-right';
        toastr.options.closeButton = 'true';
        toastr.options.progressBar = 'true';
        toastr.options.timeOut = '2500';

        let type = "{{ session()->get('alert-type', 'info') }}";
        let message = "{{ session()->get('alert-message', '') }}";
        switch (type) {
            case 'info':
                toastr.info(message);
                break;

            case 'success':
                toastr.success(message);
                break;

            case 'warning':
                toastr.warning(message);
                break;

            case 'error':
                toastr.error(message);
                break;
        }
    @endif
</script>

<script>
    $(document).ready(function () {
        const body = $('body');

        body.on('click', '.btn-action-delete', function (e) {
            e.preventDefault();
            e.stopPropagation();

            let btn = $(this);
            let form = btn.parents('form.dt-delete-form');

            Swal.fire({
                title: '{{ trans('warnings.texts.are-you-sure') }}',
                text: "{{ trans('warnings.texts.confirm') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ trans('warnings.buttons.yes') }}',
                cancelButtonText: '{{ trans('warnings.buttons.no') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        body.on('click', '.btn-application-update', function (e) {
            e.preventDefault();
            e.stopPropagation();

            let btn = $(this);
            let form = btn.parents('form.application-status-form');

            console.log(form)

            Swal.fire({
                title: '{{ trans('warnings.texts.are-you-sure') }}',
                text: "{{ trans('warnings.texts.confirm') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ trans('warnings.buttons.yes') }}',
                cancelButtonText: '{{ trans('warnings.buttons.no') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@stack('javascript')

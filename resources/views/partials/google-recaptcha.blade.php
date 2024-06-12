@if (config('googlerecaptchav2.is_service_enabled'))
    {!! GoogleReCaptchaV2::render($id) !!}
@endif

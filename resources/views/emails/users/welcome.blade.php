<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ trans('mails.welcome.title') }}</title>
</head>
<body>
    {{ trans('mails.welcome.texts.welcome') }}

    {{ trans('mails.welcome.texts.password', ['password' => $user->raw_password ?? '']) }}
</body>
</html>

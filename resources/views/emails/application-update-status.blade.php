<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ trans('mails.update-status.title', ['code' => $application->code]) }}</title>
</head>
<body>
    {!! trans('mails.update-status.texts.hello') !!}
    <br>
    <br>
    {!! trans('mails.update-status.texts.text', ['code' => $application->code, 'status' => trans('application.statuses.' . str($application->status)->replace('.', '-'))]) !!}
</body>
</html>

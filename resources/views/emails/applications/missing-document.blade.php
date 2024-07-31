<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ trans('mails.missing-document.title') }}</title>
</head>
<body>
    {{ trans('mails.missing-document.texts.text1') }}
    <br>
    <br>
    {{ trans('mails.missing-document.texts.text2') }}
    <br>
    <br>
    {{ trans('mails.missing-document.texts.text3', ['message' => $application->missing_document_description]) }}
    <br>
    <br>
    {{ trans('mails.missing-document.texts.text4') }}
</body>
</html>

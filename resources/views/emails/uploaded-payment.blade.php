<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mali Onay Bekliyor</title>
</head>
<body>
    Merhaba Yetkili;
    <br>
    <br>
    {{ $application->code }} kodlu başvuru için ödeme dekont yüklemesi yapıldı. Gitmek için <a href="{{ route('backend.applications.edit', ['applicationId' => $application->id]) }}">tıklayınız.</a>
</body>
</html>

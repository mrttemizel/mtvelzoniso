<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antalya Bilim Üniversitesi</title>
</head>
<body>

<h3>{{ $title }}</h3>
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
    <tr>
        <th>Başlık</th>
        <th>Bilgileri</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($tableData as $row)
        <tr>
            <td>{{ $row['key'] }}</td>
            <td>{{ $row['value'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>

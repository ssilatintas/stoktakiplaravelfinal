<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gelir Raporu</title>

    <link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
</head>
<body>
    <h3 class="text-center">Gelir Raporu</h3>
    <h4 class="text-center">
        Tarih {{ tanggal_indonesia($awal, false) }}
        ile
        Tarih {{ tanggal_indonesia($akhir, false) }}
        arası
    </h4>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Tarih</th>
                <th>Satış</th>
                <th>Alım</th>
                <th>Giderler</th>
                <th>Gelir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $col)
                        <td>{{ $col }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

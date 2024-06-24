<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fatura Notları</title>

    <style>
        table td {
            /* font-family: Arial, Helvetica, sans-serif; */
            font-size: 14px;
        }
        table.veri td,
        table.veri th {
            border: 1px solid #ccc;
            padding: 5px;
        }
        table.veri {
            border-collapse: collapse;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td rowspan="4" width="60%">
                <img src="{{ public_path($setting->path_logo) }}" alt="{{ $setting->path_logo }}" width="120">
                <br>
                {{ $setting->address }}
                <br>
                <br>
            </td>
            <td>Tarih</td>
            <td>: {{ tanggal_indonesia(date('Y-m-d')) }}</td>
        </tr>
        <tr>
            <td>Üye Kodu</td>
            <td>: {{ $penjualan->member->kode_member ?? '' }}</td>
        </tr>
    </table>

    <table class="veri" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Kod</th>
                <th>Ürün Adı</th>
                <th>Birim Fiyat</th>
                <th>Miktar</th>
                <th>İndirim</th>
                <th>Ara Toplam</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $key => $item)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->product->product_code }}</td>
                    <td class="text-right">{{ format_uang($item->selling_price) }}</td>
                    <td class="text-right">{{ format_uang($item->quantity) }}</td>
                    <td class="text-right">{{ $item->discount }}</td>
                    <td class="text-right">{{ format_uang($item->subtotal) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right"><b>Toplam Fiyat</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->total_price) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>İndirim</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->discount) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Toplam Ödeme</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->payment) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Alınan</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->received) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Para Üstü</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->received - $penjualan->payment) }}</b></td>
            </tr>
        </tfoot>
    </table>

    <table width="100%">
        <tr>
            <td><b>Alışverişiniz için teşekkür ederiz. Sizi tekrar görmek dileğiyle!</b></td>
            <td class="text-center">
                Kasiyer
                <br>
                <br>
                {{ auth()->user()->name }}
            </td>
        </tr>
    </table>
</body>
</html>

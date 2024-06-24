<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Küçük Not</title>

    <?php
    $stil = '
    <style>
        * {
            font-family: "consolas", sans-serif;
        }
        p {
            display: block;
            margin: 3px;
            font-size: 10pt;
        }
        table td {
            font-size: 9pt;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }

        @media print {
            @page {
                margin: 0;
                size: 75mm 
    ';
    ?>
    <?php 
    $stil .= 
        ! empty($_COOKIE['innerHeight'])
            ? $_COOKIE['innerHeight'] .'mm; }'
            : '}';
    ?>
    <?php
    $stil .= '
            html, body {
                width: 70mm;
            }
            .btn-print {
                display: none;
            }
        }
    </style>
    ';
    ?>

    {!! $stil !!}
</head>
<body onload="window.print()">
    <button class="btn-print" style="position: absolute; right: 1rem; top: rem;" onclick="window.print()">Yazdır</button>
    <div class="text-center">
        <h3 style="margin-bottom: 5px;">{{ strtoupper($setting->company_name) }}</h3>
        <p>{{ strtoupper($setting->address) }}</p>
    </div>
    <br>
    <div>
        <p style="float: left;">{{ date('d-m-Y') }}</p>
        <p style="float: right">{{ strtoupper(auth()->user()->name) }}</p>
    </div>
    <div class="clear-both" style="clear: both;"></div>
    <p>No: {{ tambah_nol_didepan($penjualan->id_penjualan, 10) }}</p>
    <p class="text-center">===================================</p>
    
    <br>
    <table width="100%" style="border: 0;">
        @foreach ($detail as $item)
            <tr>
                <td colspan="3">{{ $item->product->product_name }}</td>
            </tr>
            <tr>
                <td>{{ $item->quantity }} x {{ format_uang($item->selling_price) }}</td>
                <td></td>
                <td class="text-right">{{ format_uang($item->quantity * $item->selling_price) }}</td>
            </tr>
        @endforeach
    </table>
    <p class="text-center">-----------------------------------</p>

    <table width="100%" style="border: 0;">
        <tr>
            <td>Toplam Fiyat:</td>
            <td class="text-right">{{ format_uang($penjualan->total_price) }}</td>
        </tr>
        <tr>
            <td>Toplam Ürün:</td>
            <td class="text-right">{{ format_uang($penjualan->total_item) }}</td>
        </tr>
        <tr>
            <td>İndirim:</td>
            <td class="text-right">{{ format_uang($penjualan->discount) }}</td>
        </tr>
        <tr>
            <td>Toplam Ödeme:</td>
            <td class="text-right">{{ format_uang($penjualan->payment) }}</td>
        </tr>
        <tr>
            <td>Alınan:</td>
            <td class="text-right">{{ format_uang($penjualan->received) }}</td>
        </tr>
        <tr>
            <td>Para Üstü:</td>
            <td class="text-right">{{ format_uang($penjualan->received - $penjualan->payment) }}</td>
        </tr>
    </table>

    <p class="text-center">===================================</p>
    <p class="text-center">-- TEŞEKKÜRLER --</p>

    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
                body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight
            );

        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight="+ ((height + 50) * 0.264583);
    </script>
</body>
</html>

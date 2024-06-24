@extends('layouts.master')

@section('title')
    Satış İşlemleri
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Satış İşlemleri</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body">
                <div class="alert alert-success alert-dismissible">
                    <i class="fa fa-check icon"></i>
                    İşlem Verisi Tamamlandı.
                </div>
            </div>
            <div class="box-footer">
                @if ($setting->invoice_type == 1)
                <button class="btn btn-warning btn-flat" onclick="printInvoice('{{ route('transactions.print_small_invoice') }}', 'Küçük Fatura')">Faturayı Yazdır</button>
                @else
                <button class="btn btn-warning btn-flat" onclick="printInvoice('{{ route('transactions.print_large_invoice') }}', 'Büyük Fatura')">Faturayı Yazdır</button>
                @endif
                <a href="{{ route('transactions.new') }}" class="btn btn-primary btn-flat">Yeni İşlem</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Silmek için önce iç yükseklik cookie'sini silin
    document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    
    function printInvoice(url, title) {
        popupCenter(url, title, 625, 500);
    }

    function popupCenter(url, title, w, h) {
        const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
        const dualScreenTop  = window.screenTop  !==  undefined ? window.screenTop  : window.screenY;

        const width  = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left       = (width - w) / 2 / systemZoom + dualScreenLeft
        const top        = (height - h) / 2 / systemZoom + dualScreenTop
        const newWindow  = window.open(url, title, 
        `
            scrollbars=yes,
            width  = ${w / systemZoom}, 
            height = ${h / systemZoom}, 
            top    = ${top}, 
            left   = ${left}
        `
        );

        if (window.focus) newWindow.focus();
    }
</script>
@endpush

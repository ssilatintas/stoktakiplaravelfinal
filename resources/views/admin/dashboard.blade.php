@extends('layouts.master')

@section('title')
    Kontrol Paneli
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Kontrol Paneli</li>
@endsection

@section('content')
<!-- Küçük kutular (Stat kutusu) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- küçük kutu -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $kategori }}</h3>

                <p>Toplam Kategoriler</p>
            </div>
            <div class="icon">
                <i class="fa fa-cube"></i>
            </div>
            <a href="{{ route('kategori.index') }}" class="small-box-footer">Görüntüle <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- küçük kutu -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ $produk }}</h3>

                <p>Toplam Ürün</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ route('produk.index') }}" class="small-box-footer">Görüntüle <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- küçük kutu -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $member }}</h3>

                <p>Toplam Üye</p>
            </div>
            <div class="icon">
                <i class="fa fa-id-card"></i>
            </div>
            <a href="{{ route('member.index') }}" class="small-box-footer">Görüntüle <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- küçük kutu -->
        <div class="small-box bg-olive">
            <div class="inner">
                <h3>{{ $supplier }}</h3>

                <p>Toplam Tedarikçi</p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <a href="{{ route('supplier.index') }}" class="small-box-footer">Görüntüle <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-4 col-xs-6">
        <!-- küçük kutu -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $penjualan }}</h3>

                <p>Satışlar</p>
            </div>
            <div class="icon">
                <i class="fa fa-dollar"></i>
            </div>
            <a href="{{ route('penjualan.index') }}" class="small-box-footer">Görüntüle <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-xs-6">
        <!-- küçük kutu -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $pengeluaran }}</h3>

                <p>Toplam Giderler</p>
            </div>
            <div class="icon">
                <i class="fa fa-dollar"></i>
            </div>
            <a href="{{ route('pengeluaran.index') }}" class="small-box-footer">Görüntüle <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-xs-6">
        <!-- küçük kutu -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $pembelian }}</h3>

                <p>Toplam Satın Almalar</p>
            </div>
            <div class="icon">
                <i class="fa fa-dollar"></i>
            </div>
            <a href="{{ route('pembelian.index') }}" class="small-box-footer">Görüntüle <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- Ana satır -->
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Gelir Grafiği {{ tanggal_indonesia($tanggal_awal, false) }} - {{ tanggal_indonesia($tanggal_akhir, false) }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chart">
                            <!-- Satış Grafiği Canvas -->
                            <canvas id="salesChart" style="height: 280px;"></canvas>
                        </div>
                        <!-- /.chart-responsive -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row (main row) -->
@endsection

@push('scripts')
<!-- ChartJS -->
<script src="{{ asset('AdminLTE-2/bower_components/chart.js/Chart.js') }}"></script>
<script>
$(function() {
    // jQuery ile bağlamı alın - jQuery'nin .get() yöntemini kullanarak.
    var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
    // Bu, jQuery koleksiyonundaki ilk döndürülen düğümü alacak.
    var salesChart = new Chart(salesChartCanvas);

    var salesChartData = {
        labels: {{ json_encode($data_tanggal) }},
        datasets: [
            {
                label: 'Pendapatan',
                fillColor           : 'rgba(60,141,188,0.9)',
                strokeColor         : 'rgba(60,141,188,0.8)',
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: {{ json_encode($data_pendapatan) }}
            }
        ]
    };

    var salesChartOptions = {
        pointDot : false,
        responsive : true
    };

    salesChart.Line(salesChartData, salesChartOptions);
});
</script>
@endpush

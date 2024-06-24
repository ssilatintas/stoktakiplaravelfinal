@extends('layouts.master')

@section('title')
Gelir Raporu {{ tanggal_indonesia($tanggalAwal, false) }} -- {{ tanggal_indonesia($tanggalAkhir, false) }}
@endsection

@push('css')

<link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush
@section('breadcrumb')
@parent
<li class="active">Rapor</li>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <button onclick="updatePeriode()" class="btn btn-primary btn-flat"><i class="fa fa-plus-circle"></i> Tarih Değiştir</button>
                <!-- <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank" class="btn btn-success btn-flat"><i class="fa fa-file-excel-o"></i> PDF Olarak Dışa Aktar</a> -->
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered table-hover">
                    <thead>
                        <th width="5%">#</th>
                        <th>Tarih</th>
                        <th>Satış</th>
                        <th>Alım</th>
                        <th>Giderler</th>
                        <th>Gelir</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- "codeastro" ziyaret edin, daha fazla proje için! -->
@includeIf('laporan.form')
@endsection
@push('scripts')

<script src="{{ asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'tanggal'},
                {data: 'penjualan'},
                {data: 'pembelian'},
                {data: 'pengeluaran'},
                {data: 'pendapatan'}
            ],
            dom: 'Brt',
            bSort: false,
            bPaginate: false,
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

    function updatePeriode() {
        $('#modal-form').modal('show');
    }
</script>
@endpush
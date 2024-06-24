@extends('layouts.master')

@section('title')
    Kontrol Paneli
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Kontrol Paneli</li>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body text-center">
                <h1>HOŞGELDİNİZ,</h1>
                <h2>KASİYER olarak oturum açtınız</h2>
                <br><br>
                <a href="{{ route('transaksi.baru') }}" class="btn btn-success btn-lg">Yeni İşlem</a>
                <br><br><br>
            </div>
        </div>
    </div>
</div>
@endsection

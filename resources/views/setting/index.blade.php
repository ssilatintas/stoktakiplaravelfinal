@extends('layouts.master')

@section('title')
    Settings
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Settings</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <form action="{{ route('setting.update') }}" method="post" class="form-setting" data-toggle="validator" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="alert alert-info alert-dismissible" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-check"></i> Changes saved successfully
                    </div>
                    <div class="form-group row">
                        <label for="nama_perusahaan" class="col-lg-2 control-label">Şirket İsmi</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_perusahaan" class="form-control" id="nama_perusahaan" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telepon" class="col-lg-2 control-label">Telefon</label>
                        <div class="col-lg-6">
                            <input type="text" name="telepon" class="form-control" id="telepon" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-lg-2 control-label">Adres</label>
                        <div class="col-lg-6">
                            <textarea name="alamat" class="form-control" id="alamat" rows="3" required></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="path_logo" class="col-lg-2 control-label">Logo</label>
                        <div class="col-lg-4">
                            <input type="file" name="path_logo" class="form-control" id="path_logo"
                                onchange="preview('.tampil-logo', this.files[0])">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-logo"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="path_kartu_member" class="col-lg-2 control-label">Üyelik Kartı</label>
                        <div class="col-lg-4">
                            <input type="file" name="path_kartu_member" class="form-control" id="path_kartu_member"
                                onchange="preview('.tampil-kartu-member', this.files[0], 300)">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-kartu-member"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diskon" class="col-lg-2 control-label">İndirim</label>
                        <div class="col-lg-2">
                            <input type="number" name="diskon" class="form-control" id="diskon" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tipe_nota" class="col-lg-2 control-label">Not tipi</label>
                        <div class="col-lg-2">
                            <select name="tipe_nota" class="form-control" id="tipe_nota" required>
                                <option value="1">Küçük Fatura</option>
                                <option value="2">PDF Fatura</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i>Değişikleri Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        showData();

        $('.form-setting').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.ajax({
                    url: $('.form-setting').attr('action'),
                    type: $('.form-setting').attr('method'),
                    data: new FormData($('.form-setting')[0]),
                    async: false,
                    processData: false,
                    contentType: false
                })
                .done(response => {
                    showData();
                    $('.alert').fadeIn();

                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 3000);
                })
                .fail(errors => {
                    alert('Unable to save data');
                    return;
                });
            }
        });
    });

    function showData() {
        $.get('{{ route('setting.show') }}')
            .done(response => {
                $('[name=nama_perusahaan]').val(response.nama_perusahaan);
                $('[name=telepon]').val(response.telepon);
                $('[name=alamat]').val(response.alamat);
                $('[name=diskon]').val(response.diskon);
                $('[name=tipe_nota]').val(response.tipe_nota);
                $('title').text(response.nama_perusahaan + ' | Settings');
                
                let words = response.nama_perusahaan.split(' ');
                let word  = '';
                words.forEach(w => {
                    word += w.charAt(0);
                });
                $('.logo-mini').text(word);
                $('.logo-lg').text(response.nama_perusahaan);

                $('.tampil-logo').html(`<img src="{{ url('/') }}${response.path_logo}" width="200">`);
                $('.tampil-kartu-member').html(`<img src="{{ url('/') }}${response.path_kartu_member}" width="300">`);
                $('[rel=icon]').attr('href', `{{ url('/') }}/${response.path_logo}`);
            })
            .fail(errors => {
                alert('Unable to display data');
                return;
            });
    }
</script>
@endpush
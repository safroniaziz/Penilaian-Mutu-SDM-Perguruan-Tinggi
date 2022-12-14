@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;DASHBOARD
@endsection
@section('user-login')
    @if (Auth::check())
        {{ Auth::user()->nama_lengkap }}
    @endif
@endsection
@section('halaman')
    Halaman LPMPP
@endsection
@section('content-title')
    Dashboard
    <small>PENJAMINAN MUTU BIDANG SUMBER DAYA MANUSIA</small>
@endsection
@section('page')
    <li><a href="#"><i class="fa fa-home"></i> Evaluasi Mutu SDM</a></li>
    <li class="active">Dashboard</li>
@endsection
@section('sidebar-menu')
    @include('lpmpp/sidebar')
@endsection
@section('user')
    <!-- User Account Menu -->
    <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <i class="fa fa-user"></i>&nbsp;
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('logout') }}" class="btn btn-danger"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>&nbsp; Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
@endsection
@push('styles')
    <style>
        #chartdiv {
            width: 90%;
            height: 500px;
        }
    </style>
    <style>
        .preloader {    position: fixed;    top: 0;    left: 0;    right: 0;    bottom: 0;    background-color: #ffffff;    z-index: 99999;    height: 100%;    width: 100%;    overflow: hidden !important;}.do-loader{    width: 200px;    height: 200px;    position: absolute;    left: 50%;    top: 50%;    margin: 0 auto;    -webkit-border-radius: 100%;       -moz-border-radius: 100%;         -o-border-radius: 100%;            border-radius: 100%;    background-image: url({{ asset('assets/images/logo.png') }});    background-size: 80% !important;    background-repeat: no-repeat;    background-position: center;    -webkit-background-size: cover;            background-size: cover;    -webkit-transform: translate(-50%,-50%);       -moz-transform: translate(-50%,-50%);        -ms-transform: translate(-50%,-50%);         -o-transform: translate(-50%,-50%);            transform: translate(-50%,-50%);}.do-loader:before {    content: "";    display: block;    position: absolute;    left: -6px;    top: -6px;    height: calc(100% + 12px);    width: calc(100% + 12px);    border-top: 1px solid #07A8D8;    border-left: 1px solid transparent;    border-bottom: 1px solid transparent;    border-right: 1px solid transparent;    border-radius: 100%;    -webkit-animation: spinning 0.750s infinite linear;       -moz-animation: spinning 0.750s infinite linear;         -o-animation: spinning 0.750s infinite linear;            animation: spinning 0.750s infinite linear;}@-webkit-keyframes spinning {   from {-webkit-transform: rotate(0deg);}   to {-webkit-transform: rotate(359deg);}}@-moz-keyframes spinning {   from {-moz-transform: rotate(0deg);}   to {-moz-transform: rotate(359deg);}}@-o-keyframes spinning {   from {-o-transform: rotate(0deg);}   to {-o-transform: rotate(359deg);}}@keyframes spinning {   from {transform: rotate(0deg);}   to {transform: rotate(359deg);}}
    </style>
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-calendar-times-o"></i>&nbsp;Edit Data Indikator Penilaian</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">??</button>
                                <strong>Berhasil :</strong>{{ $message }}
                            </div>
                            @elseif ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">??</button>
                                    <strong>Gagal :</strong>{{ $message }}
                                </div>
                                @else
                        @endif
                    </div>

                    <form action="{{ route('lpmpp.indikator.update',[$data->id]) }}" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                        <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Nama Bab</label>
                                <select name="nama_bab" class="form-control">
                                    <option value="">Pilih Nama Bab</option>
                                    @foreach ($bab as $bab)
                                            <option value="{{ $bab->id }}" {{ $bab->id == $data->bab_indikator_ban_pt_dosen_id ? 'selected' : '' }}>{{ $bab->nama_bab }} </option>
                                    @endforeach
                                </select>
                                <div>
                                    @if ($errors->has('nama_bab'))
                                        <small class="form-text text-danger">{{ $errors->first('nama_bab') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Indikator</label>
                                <input type="text" name="indikator" class="form-control" value="{{ $data->indikator }}">
                                <div>
                                    @if ($errors->has('indikator'))
                                        <small class="form-text text-danger">{{ $errors->first('indikator') }}</small>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Skor</label>
                                <input type="number" name="skor" class="form-control" id="skor"  value="{{ $data->skor }}" >
                                <div>
                                    @if ($errors->has('skor'))
                                        <small class="form-text text-danger">{{ $errors->first('skor') }}</small>
                                    @endif
                                </div>
                            </div> --}}

                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <textarea class="form-control" name="keterangan" style="height: 150px;" > {{ $data->keterangan }}</textarea>

                                <div>
                                    @if ($errors->has('keterangan'))
                                        <small class="form-text text-danger">{{ $errors->first('keterangan') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <a href="{{ route('lpmpp.indikator') }}" class="btn btn-warning btn-sm" style="color: white"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
                                <button type="reset" name="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i>&nbsp;Ulangi</button>
                                <button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp;Simpan</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('#year').each(function() {
            var year = (new Date()).getFullYear();
            var current = year;
            year -= 2;
            for (var i = 0; i < 3; i++) {
            if ((year+i) == current)
                $(this).append('<option selected value="' + (year + i) + '">' + (year + i) + '</option>');
            else
                $(this).append('<option value="' + (year + i) + '">' + (year + i) + '</option>');
            }
        });

        $(document).on('change','#status_pimpinan',function(){
            var status_pimpinan = $(this).val();
            var div = $(this).parent().parent();
            var op=" ";
            $.ajax({
            type :'get',
            url: "{{ url('lpmpp/manajemen_data_fakultas/cari_pimpinan') }}",
            data:{'status_pimpinan':status_pimpinan},
                success:function(data){
                    op+='<option value="0" selected disabled>-- pilih pimpinan --</option>';
                    for(var i=0; i<data.length;i++){
                        op+='<option value="'+data[i].nama_pimpinan+'">'+data[i].nama_pimpinan+'</option>';
                    }
                    div.find('#pimpinan_id').html(" ");
                    div.find('#pimpinan_id').append(op);
                    if (data.length <1) {
                        $("#tidak_ditemukan").show();
                    }else{
                        $("#tidak_ditemukan").hide();
                    }
                },
                    error:function(){
                }
            });
        });
    </script>
@endpush

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
    Program Studi
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
    @include('operator_prodi/sidebar')
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
                <h3 class="box-title"><i class="fa fa-pencil"></i>&nbsp;Manajemen EditData Tendikk</h3>

            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Berhasil :</strong>{{ $message }}
                            </div>
                            @elseif ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Gagal :</strong>{{ $message }}
                                </div>
                                @else
                        @endif
                    </div>

                    <form action="{{ route('operator_prodi.dosen.update',[$data->id]) }}" method="POST" >
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ $data->nama_lengkap }}" class="form-control" >
                            <div>
                                @if ($errors->has('nama_lengkap'))
                                    <small class="form-text text-danger">{{ $errors->first('nama_lengkap') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">NIP</label>
                            <input type="text" name="nip" value="{{ $data->nip }}" class="form-control" >
                            <div>
                                @if ($errors->has('nip'))
                                    <small class="form-text text-danger">{{ $errors->first('nip') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">NIDN</label>
                            <input type="text" name="nidn" value="{{ $data->nidn }}" class="form-control" >
                            <div>
                                @if ($errors->has('nidn'))
                                    <small class="form-text text-danger">{{ $errors->first('nidn') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Pangkat</label>
                            <input type="text" name="pangkat" value="{{ $data->pangkat }}" class="form-control" >
                            <div>
                                @if ($errors->has('pangkat'))
                                    <small class="form-text text-danger">{{ $errors->first('pangkat') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Golongan</label>
                            <input type="text" name="golongan" value="{{ $data->golongan }}" class="form-control" >
                            <div>
                                @if ($errors->has('golongan'))
                                    <small class="form-text text-danger">{{ $errors->first('golongan') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Tempat, Tanggal Lahir</label>
                            <input type="text" name="ttl" value="{{ $data->ttl }}" class="form-control" >
                            <div>
                                @if ($errors->has('ttl'))
                                    <small class="form-text text-danger">{{ $errors->first('ttl') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Perguruan Tinggi S1</label>
                            <input type="text" name="s1" value="{{ $data->s1 }}" class="form-control" >
                            <div>
                                @if ($errors->has('s1'))
                                    <small class="form-text text-danger">{{ $errors->first('s1') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Perguruan Tinggi S2</label>
                            <input type="text" name="s2" value="{{ $data->s2 }}" class="form-control" >
                            <div>
                                @if ($errors->has('s2'))
                                    <small class="form-text text-danger">{{ $errors->first('s2') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Perguruan Tinggi S3</label>
                            <input type="text" name="s3" value="{{ $data->s3 }}" class="form-control" >
                            <div>
                                @if ($errors->has('s3'))
                                    <small class="form-text text-danger">{{ $errors->first('s3') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Ilmu Yang Ditekuni</label>
                            <input type="text" name="ilmu" value="{{ $data->ilmu }}" class="form-control" >
                            <div>
                                @if ($errors->has('ilmu'))
                                    <small class="form-text text-danger">{{ $errors->first('ilmu') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Nomor Handphone</label>
                            <input type="text" name="no_hp" value="{{ $data->no_hp }}" class="form-control" >
                            <div>
                                @if ($errors->has('no_hp'))
                                    <small class="form-text text-danger">{{ $errors->first('no_hp') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <a href="{{ route('operator_prodi.dosen') }}" class="btn btn-warning btn-sm" style="color: white"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
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
        $(document).on('change','#unit_id',function(){
            var unit_id = $(this).val();
            var div = $(this).parent().parent();
            var op=" ";
            $.ajax({
            type :'get',
            url: "{{ url('operator_prodi/manajemen_data_dosen/cari_prodi') }}",
            data:{'unit_id':unit_id},
                success:function(data){
                    op+='<option value="0" selected disabled>-- pilih prodi --</option>';
                    for(var i=0; i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].nama_prodi+'</option>';
                    }
                    div.find('#prodi_id').html(" ");
                    div.find('#prodi_id').append(op);
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

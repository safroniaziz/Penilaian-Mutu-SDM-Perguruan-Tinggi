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
    <div class="col-md-4 sm-6">
        <div class="box box-info">
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user"></i>&nbsp;Profil Saya</h3>
            </div>
            <div class="box-body box-profile">
                @if (Auth::user()->foto == null)
                    <img class="profile-user-img img-responsive img-circle" src="https://cdn-icons-png.flaticon.com/128/1177/1177568.png" alt="User profile picture">
                @else
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('upload/userimage/'.Auth::user()->foto) }}" alt="User profile picture">
                @endif
                <h3 class="profile-username text-center">{{ Auth::user()->firstName }}</h3>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>NIP</b> <a class="pull-right">{{ Auth::user()->nip }}</a>
                        </li>
                        <li class="list-group-item">
                        <b>Nama Lengkap</b> <a class="pull-right">{{ Auth::user()->nama_lengkap }}</a>
                        </li>
                        <li class="list-group-item">
                        <b>Status User</b> <a class="pull-right">
                            LPMPP
                        </a>
                    </li>
                </ul>
                <button type="button" class="btn btn-primary btn-sm btn-flat btn-block" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-key"></i>&nbsp;Ubah Password
                </button>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action=" {{ route('lpmpp.profil.ubah_password') }} " method="POST">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Ubah Password
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </h5>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                            <label for="">Masukan Password</label>
                                            <input type="hidden" name="id" id="id" value={{ Auth::user()->id}}>
                                            <input type="password" name="password_ubah" id="password_ubah" class="form-control password">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">Konfirmasi Password</label>
                                        <input type="password" name="password_ubah2" id="password_ubah2" class="form-control password2">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <a class="password_ubah_sama" style="color: green; font-size:12px; font-style:italic; display:none;"><i class="fa fa-check-circle"></i>&nbsp;Password Sama!!</a>
                                        <a class="password_ubah_tidak_sama" style="color: red; font-size:12px; font-style:italic; display:none;"><i class="fa fa-close"></i>&nbsp;Password Tidak Sama!!</a>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batalkan</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="btn-submit-ubah" disable><i class="fa fa-check-circle"></i>&nbsp; Ubah Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#settings" data-toggle="tab"><i class="fa fa-cog"></i>&nbsp;Pengaturan</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="settings">
                    <form class="form-horizontal" action="{{ route('lpmpp.profil.update',[Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="nama_lengkap" class="col-sm-2 control-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_lengkap" class="form-control" value="{{ Auth::user()->nama_lengkap }}" id="nama_lengkap">
                                <div>
                                    @if ($errors->has('nama_lengkap'))
                                        <small class="form-text text-danger">{{ $errors->first('nama_lengkap') }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nip" class="col-sm-2 control-label">Nip</label>
                            <div class="col-sm-10">
                                <input type="text" name="nip" value="{{ Auth::user()->nip }}" class="form-control" id="nip">
                                <div>
                                    @if ($errors->has('nip'))
                                        <small class="form-text text-danger">{{ $errors->first('nip') }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nip" class="col-sm-2 control-label">Unit Kerja</label>
                            <div class="col-sm-10">
                                <input type="text" disabled class="form-control" value="{{ Auth::user()->unit->nama_unit }}">
                                <div>
                                    @if ($errors->has('nip'))
                                        <small class="form-text text-danger">{{ $errors->first('nip') }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="reset" name="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i>&nbsp;Reset</button>
                                    <button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp;Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
      <!-- /.col -->
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $("#password_ubah, #password_ubah2").keyup(function(){
                var password_ubah = $("#password_ubah").val();
                var ulangi = $("#password_ubah2").val();
                if($("#password_ubah").val() == $("#password_ubah2").val()){
                    $('.password_ubah_sama').show(200);
                    $('.password_ubah_tidak_sama').hide(200);
                    $('#btn-submit-ubah').attr("disabled",false);
                }
                else{
                    $('.password_ubah_sama').hide(200);
                    $('.password_ubah_tidak_sama').show(200);
                    $('#btn-submit-ubah').attr("disabled",true);
                }
            });
        });
    </script>
@endpush

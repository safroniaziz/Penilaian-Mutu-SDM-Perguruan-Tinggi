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
    {{ Auth::user()->unit->nama_unit }}
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
    @include('operator_unit/sidebar')
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
    <div class="callout callout-info">
        <h4>Selamat Datang <b>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</b></h4>

        <p>
            Aplikasi Evaluasi Mutu SDM adalah aplikasi yang digunakan untuk melakukan proses evaluasi mutu sumber daya manusia perguruan tinggi, dalam hal ini adalah Tenaga Pendidik (Dosen), dan Tenaga Kependidikan (Tendik)
            <br>
            <i><b>Catatan</b>: Untuk keamanan, jangan lupa keluar setelah menggunakan aplikasi</i>
        </p>
    </div>
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
                            {{ Auth::user()->akses }}
                        </a>
                        </li>
                    </ul>
                    <a href="{{ route('operator_unit.profil') }}" class="btn btn-primary btn-sm btn-flat btn-block">
                        <i class="fa fa-edit"></i>&nbsp;Edit Profil
                    </a>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <div class="col-md-8 sm-6">
            <div class="box box-primary">

                <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-info-circle"></i>&nbsp;Informasi Siswa</h3>
                </div>
                <div class="box-body">
                    <div class="col-lg-6 col-xs-12">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3></h3>

                                <p>Kelas Tersedia</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="small-box bg-green">
                                <div class="inner">
                                <h3><sup style="font-size: 20px"></sup>  </h3>

                                <p>Kelas Diambil</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <a href="" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>  </h3>

                                <p>Membuat Forum</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <a href="" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>  </h3>

                                <p>Kelas Selesai</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-key"></i>
                            </div>
                            <a href="" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection

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
    @include('lpmpp/prodi._loader')
    <style>
        #chartdiv, #chartdiv2 {
            width: 90%;
            height: 350px;
        }
    </style>
    <style>
        .preloader {    position: fixed;    top: 0;    left: 0;    right: 0;    bottom: 0;    background-color: #ffffff;    z-index: 99999;    height: 100%;    width: 100%;    overflow: hidden !important;}.do-loader{    width: 200px;    height: 200px;    position: absolute;    left: 50%;    top: 50%;    margin: 0 auto;    -webkit-border-radius: 100%;       -moz-border-radius: 100%;         -o-border-radius: 100%;            border-radius: 100%;    background-image: url({{ asset('assets/images/logo.png') }});    background-size: 80% !important;    background-repeat: no-repeat;    background-position: center;    -webkit-background-size: cover;            background-size: cover;    -webkit-transform: translate(-50%,-50%);       -moz-transform: translate(-50%,-50%);        -ms-transform: translate(-50%,-50%);         -o-transform: translate(-50%,-50%);            transform: translate(-50%,-50%);}.do-loader:before {    content: "";    display: block;    position: absolute;    left: -6px;    top: -6px;    height: calc(100% + 12px);    width: calc(100% + 12px);    border-top: 1px solid #07A8D8;    border-left: 1px solid transparent;    border-bottom: 1px solid transparent;    border-right: 1px solid transparent;    border-radius: 100%;    -webkit-animation: spinning 0.750s infinite linear;       -moz-animation: spinning 0.750s infinite linear;         -o-animation: spinning 0.750s infinite linear;            animation: spinning 0.750s infinite linear;}@-webkit-keyframes spinning {   from {-webkit-transform: rotate(0deg);}   to {-webkit-transform: rotate(359deg);}}@-moz-keyframes spinning {   from {-moz-transform: rotate(0deg);}   to {-moz-transform: rotate(359deg);}}@-o-keyframes spinning {   from {-o-transform: rotate(0deg);}   to {-o-transform: rotate(359deg);}}@keyframes spinning {   from {transform: rotate(0deg);}   to {transform: rotate(359deg);}}
    </style>
@endpush
@section('content')
<div class="row">
    
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data Program Studi</h3>
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
                    <div class="col-md-12" id="sync" style="display: none">
                        <div class="alert alert-warning">
                            <!-- Loading Spinner Wrapper-->
                            <div class="loader text-center">
                                <div class="loader-inner">

                                    <!-- Animated Spinner -->
                                    <div class="lds-roller mb-3">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    
                                    <!-- Spinner Description Text [For Demo Purpose]-->
                                    <h4 class="font-weight-bold">Proses Sinkronisasi sedang berjalan</h4>
                                    <p class="font-italic text-white">Harap untuk menunggu hingga proses selesai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 10px !important;">
                        <div class="alert alert-info">
                            <b>Perhatian</b> <br>
                            Data Program Studi, Data Mahasiswa dan Data Dosen tersinkronisasi dengan portal akademik Universitas Bengkulu, untuk mengupdate data silahkan klik sinkronisasi untuk masing-masing data dibawah ini
                        </div>
                        {{-- <a href="{{ route('lpmpp.prodi.add') }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i>&nbsp; Tambah Prodi</a> --}}
                        <a href="{{ route('lpmpp.prodi.sync') }}" onclick="sinkronisasiPanda()" class="btn btn-success btn-sm btn-flat"><i class="fa fa-refresh fa-spin"></i>&nbsp; Sinkronisasi Data Prodi</a>
                    </div>
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped table-bordered" id="table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Prodi</th>
                                    <th class="text-center">Jumlah Mahasiswa</th>
                                    <th class="text-center">Jumlah Dosen</th>
                                    <th>Fakultas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($prodis as $prodis)
                                    <tr>
                                        <td> {{ $no++ }} </td>
                                        <td> {{ $prodis->nama_prodi }} </td>
                                        <td class="text-center">
                                            @if ($prodis->mahasiswas()->get()->count() > 0)
                                                <a href="{{ route('lpmpp.prodi.detail_mahasiswa',[$prodis->id]) }}" class="btn btn-info btn-sm btn-flat">{{ $prodis->mahasiswas()->get()->count() }}</a>
                                            @else
                                                <a href="{{ route('lpmpp.prodi.sync_mahasiswa',[$prodis->id]) }}" onclick="sinkronisasiPanda()" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-refresh fa-spin"></i>&nbsp; Sync Pangkalan Data</a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($prodis->dosens()->get()->count() > 0)
                                            <a href="{{ route('lpmpp.prodi.detail_dosen',[$prodis->id]) }}" class="btn btn-info btn-sm btn-flat">{{ $prodis->dosens()->get()->count() }}</a>
                                        @else
                                            <a href="{{ route('lpmpp.prodi.sync_dosen',[$prodis->id]) }}" onclick="sinkronisasiPanda()" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh fa-spin"></i>&nbsp; Sync Pangkalan Data</a>
                                        @endif
                                        </td>
                                        <td> {{ $prodis->unit->nama_unit }} </td>
                                            <td style="display:inline-block !important;">
                                                <table>
                                                    <tr>
                                                        <td>
                                                        <a href="{{ route('lpmpp.prodi.edit',[$prodis->id]) }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-edit"></i>&nbsp; Edit</a>
                                                        </td>
                                                        <td>
                                                        <form action="{{ route('lpmpp.prodi.delete',[$prodis->id]) }}" method="POST">
                                                                {{ csrf_field() }} {{ method_field("DELETE") }}
                                                                <a href="" onClick="return confirm('Apakah anda yakin menghapus data ini?')"/><button type="submit" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i>&nbsp; Hapus</button></a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('lpmpp/prodi._grafik_mahasiswa')
    @include('lpmpp/prodi._grafik_dosen')
</div>
@endsection
@push('scripts')
    @include('lpmpp/prodi/_pie_chart_mahasiswa')
    @include('lpmpp/prodi/_pie_chart_dosen')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        
        function sinkronisasiPanda(){
            $('#sync').show(300);
            $('.loader').show(300);
        }

        // FOR DEMO PURPOSE
        $(window).on('load', function () {
            var loadingCounter = setInterval(function () {
                var count = parseInt($('.countdown').html());
                if (count !== 0) {
                    $('.countdown').html(count - 1);
                } else {
                    clearInterval();
                }
            }, 1000);
        });
        $('#reload').on('click', function (e) {
            e.preventDefault();
            location.reload();
        });


        $(document).ready(function() {
            $('#table').DataTable({
                responsive : true,
            });
        } );

        function deleteCourse(id){
            $('#modaldelete').modal('show');
            $('#id_hapus').val(id);
        }

        $(document).on('change','#visibility',function(){
            var visibility = $(this).val();
            var div = $(this).parent().parent();
            $.ajax({
            type :'get',
            url: "{{ url('teacher/indikator/update_visibility') }}",
            data:{'visibility':visibility},
                success:function(data){

                },
                    error:function(){
                }
            });
        })
    </script>
@endpush

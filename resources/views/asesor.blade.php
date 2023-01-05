@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;DASHBOARD
@endsection
@section('user-login')
    FAISAL HADI S.T, M.T
@endsection
@section('halaman')
    Asesor Fakultas Teknik
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
    @include('asesor_sidebar')
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                <h3 class="box-title"><i class="fa fa-user"></i>&nbsp;Pemilaian Kinerja Pegawai</h3>
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
                    <div class="col-md-12">
                        <h2>Nama Dosen : Drs. Boko Susilo, M.Kom</h2>
                    </div>
                <div class="col-md-12 table-responsive" style="margin-top:10px !important">
                    <table class="table table-striped table-bordered" id="table" style="width:100%;">
                        <thead>
                            <tr>
                                <th rowspan="3">No</th>
                                <th rowspan="3" style="vertical-align : middle;text-align:center;">Kriteria Penilaian</th>
                                <th rowspan="3" style="vertical-align : middle;text-align:center;">Indikator Penilaian</th>
                                <th rowspan="3" style="vertical-align : middle;text-align:center;">Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            <tr>
                                <td>1</td>
                                <td> LKPT
                                    Kecukupan Dosen
                                    Perguruan Tinggi
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Persentase jumlah dosen
                                    yang memiliki jabatan
                                    fungsional Guru Besar
                                    terhadap jumlah seluruh
                                    dosen tetap.

                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Persentase jumlah dosen
                                    yang memiliki sertifikat
                                    pendidik profesional
                                    /sertifikat profesi
                                    terhadap jumlah seluruh
                                    dosen tetap
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Rata-rata
                                    penelitian/dosen/tahun
                                    dalam 3 tahun terakhir
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Rata-rata
                                    PkM/dosen/tahun dalam
                                    3 tahun terakhir.
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Rata-rata jumlah
                                    pengakuan atas prestasi/
                                    kinerja dosen terhadap jumlah dosen tetap
                                    dalam 3 tahun terakhir.
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Rasio jumlah mahasiswa
                                    terhadap jumlah dosen
                                    tetap.
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td> Persentase jumlah dosen
                                    tidak tetap terhadap
                                    jumlah seluruh dosen
                                    (dosen tetap dan dosen
                                    tidak tetap).
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Persentase jumlah dosen
                                    yang memiliki sertifikat
                                    pendidik profesional
                                    /sertifikat profesi
                                    terhadap jumlah seluruh
                                    dosen tetap.

                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Rata-rata
                                    PkM/dosen/tahun dalam
                                    3 tahun terakhir.
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            {{-- @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        {{ $data->jenis_kegiatan }}
                                    </td>
                                    <td>{{ $data->bukti_penugasan }}</td>
                                    <td>{{ $data->sks_beban_kerja }}</td>
                                    <td>{{ $data->masa_tugas }}</td>
                                    <td>{{ $data->bukti_dokumen }}</td>
                                    <td>{{ $data->persentase_capaian }}</td>
                                    <td>{{ $data->sks_kinerja }}</td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <a href="{{ route('operator_unit.formulir.edit',[$data->id]) }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-edit"></i>&nbsp; Edit</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('operator_unit.formulir.delete',[$data->id]) }}" method="POST">
                                                        {{ csrf_field() }} {{ method_field("DELETE") }}
                                                        <a href="" onClick="return confirm('Apakah anda yakin menghapus data ini?')"/><button type="submit" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i>&nbsp; Hapus</button></a>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        $('.select2').select2({

        });
        $(document).ready(function() {
            $('#table').DataTable({
                responsive : true,
            });
        } );
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endpush

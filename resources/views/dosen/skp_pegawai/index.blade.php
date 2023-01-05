@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;DASHBOARD
@endsection
@section('user-login')
    {{ Session::get('dosen')->nama_dosen }}
@endsection
@section('halaman')
    Halaman Dosen
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
    @include('dosen/sidebar')
@endsection
@section('user')
    <!-- User Account Menu -->
    <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <i class="fa fa-user"></i>&nbsp;
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{ $dosen->nama_dosen }} </span>
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
    @if ($dosen->skp()->count() >0)
        <div class="col-md-12">
            <div class="row">
                @include('dosen/skp_pegawai.pejabat_dinilai')
                @include('dosen/skp_pegawai.pejabat_penilai')
                @include('dosen/skp_pegawai.atasan_pejabat_penilai')
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                @include('dosen/skp_pegawai.list_skp_detail')
            </div>
        </div>
    @else
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-list"></i>&nbsp;Data SKP Dosen </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <i class="fa fa-warning"></i>&nbsp;Silahkan Tambahkan Data SKP Anda Terlebih Dahulu
                            </div>
                            <button type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#modal-default">
                                <i class="fa fa-plus"></i>&nbsp;Tambah Data SKP
                            </button>
                        </div>
                        <div class="modal fade" id="modal-default">
                            <form action="{{ route('dosen.skp.post',[$dosen->id]) }}" method="POST">
                                {{ csrf_field() }} {{ method_field("POST") }}
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Formulir Tambah Data SKP Dosen</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="">Pejabat Penilai</label>
                                                    <select name="pejabat_penilai_id" id="" class="form-control">
                                                        <option disabled selected></option>
                                                        @foreach ($pejabats as $pejabat)
                                                            <option value="{{ $pejabat->id }}">{{ $pejabat->nama_dosen }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Atasan Pejabat Penilai</label>
                                                    <select name="atasan_pejabat_penilai_id" id="" class="form-control">
                                                        <option disabled selected></option>
                                                        @foreach ($pejabats as $pejabat)
                                                            <option value="{{ $pejabat->id }}">{{ $pejabat->nama_dosen }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Periode</label>
                                                    <select name="triwulan" id="" class="form-control">
                                                        <option disabled selected></option>
                                                        <option value="1">Triwulan 1</option>
                                                        <option value="2">Triwulan 2</option>
                                                        <option value="3">Triwulan 3</option>
                                                        <option value="4">Triwulan 4</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Periode Penilaian Dari</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" value="{{ old('periode_awal') }}" name="periode_awal" id="periode_awal" class="form-control pull-right">
                        
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Periode Penilaian Sampai</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" value="{{ old('periode_akhir') }}" name="periode_akhir" id="periode_akhir" class="form-control pull-right">
                        
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Capaian Kinerja Organisasi</label>
                                                    <select name="capaian_kinerja_organisasi" id="" class="form-control">
                                                        <option disabled selected></option>
                                                        <option value="istimewa">Istimewa</option>
                                                        <option value="baik">Baik</option>
                                                        <option value="butuh_perbaikan">Butuh Perbaikan</option>
                                                        <option value="kurang">Kurang/MissConduct</option>
                                                        <option value="sangat_kurang">Sangat Kurang</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Tanggal Tanda Tangan Pejabat</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" value="{{ old('ttd_pejabat') }}" name="ttd_pejabat" id="ttd_pejabat" class="form-control pull-right">
                        
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Tanggal Tanda Tangan Pejabat Penilai</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" value="{{ old('ttd_pejabat_penilai') }}" name="ttd_pejabat_penilai" id="ttd_pejabat_penilai" class="form-control pull-right">
                        
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Tanggal Tanda Tangan Atasan Pejabat Penilai</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" value="{{ old('ttd_atasan_pejabat_penilai') }}" name="ttd_atasan_pejabat_penilai" id="ttd_atasan_pejabat_penilai" class="form-control pull-right">
                        
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Rating Hasil Kerja</label>
                                                    <select name="rating_hasil_kerja" id="" class="form-control">
                                                        <option disabled selected></option>
                                                        <option value="diatas_ekspektasi">DI ATAS EKSPEKTASI</option>
                                                        <option value="sesuai_ekspektasi">SESUAI EKSPEKTASI</option>
                                                        <option value="dibawah_ekspektasi">DI BAWAH EKSPEKTASI</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Rating Perilaku Kerja</label>
                                                    <select name="rating_perilaku_kerja" id="" class="form-control">
                                                        <option disabled selected></option>
                                                        <option value="diatas_ekspektasi">DI ATAS EKSPEKTASI</option>
                                                        <option value="sesuai_ekspektasi">SESUAI EKSPEKTASI</option>
                                                        <option value="dibawah_ekspektasi">DI BAWAH EKSPEKTASI</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm btn-flat " data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batalkan</button>
                                            <button type="submit" id="btnSubmit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp;Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
</div>
@endsection
@push('scripts')
    <script>
        $(document).on('submit','form',function (event){
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                typeData: "JSON",
                data: new FormData(this),
                processData:false,
                contentType:false,
                success : function(res) {
                    $("#btnSubmit"). attr("disabled", true);
                    toastr.success(res.text, 'Yeay, Berhasil');
                    setTimeout(function () {
                        window.location.href=res.url;
                    } , 500);
                },
                error:function(xhr){
                    toastr.error(xhr.responseJSON.text, 'Ooopps, Ada Kesalahan');
                }
            })
        });

        $('#periode_awal').datepicker({
            format: 'yyyy/mm/dd', autoclose: true
        });
        $('#periode_akhir').datepicker({
            format: 'yyyy/mm/dd', autoclose: true
        });
        $('#ttd_pejabat').datepicker({
            format: 'yyyy/mm/dd', autoclose: true
        });
        $('#ttd_pejabat_penilai').datepicker({
            format: 'yyyy/mm/dd', autoclose: true
        });
        $('#ttd_atasan_pejabat_penilai').datepicker({
            format: 'yyyy/mm/dd', autoclose: true
        });
    </script>
@endpush

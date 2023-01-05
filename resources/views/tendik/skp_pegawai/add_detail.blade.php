@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;DASHBOARD
@endsection
@section('user-login')
    {{ Auth::guard('tendik')->user()->nama_tendik }}
@endsection
@section('halaman')
    Halaman Tendik
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
    @include('tendik/sidebar')
@endsection
@section('user')
    <!-- User Account Menu -->
    <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <i class="fa fa-user"></i>&nbsp;
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{ Auth::guard('tendik')->user()->nama_tendik }}</span>
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
        #chartdivperfakultas {
            width: 90%;
            height: 350px;
        }
        #chartdivperjabatantendik {
            width: 90%;
            height: 350px;
        }
        #chartdivperjk {
            width: 90%;
            height: 350px;
        }
        #chartdivtendikpergolongan {
            width: 90%;
            height: 350px;
        }

        #chartdivperunit {
            width: 90%;
            height: 350px;
        }
        #chartdivtendikpergolongan {
            width: 90%;
            height: 500px;
        }
        #chartdivtendikperpangkat {
            width: 90%;
            height: 500px;
        }
        #chartdivtendikperkelas {
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
                <h3 class="box-title"><i class="fa fa-user-circle"></i>&nbsp;Tambah Data Detail SKP tendik</h3>
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
                    <form action="{{ route('tendik.skp.detail_post',[$skp->id]) }}" method="POST" >
                        {{ csrf_field() }} {{ method_field('POST') }}
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">IKK Pimpinan</label>
                                <select name="ikk_pimpinan_id" id="ikk_pimpinan_id" class="form-control">
                                    <option disabled selected></option>
                                    @foreach ($ikus as $iku)
                                        <option value="{{ $iku->id }}">{{ '('.$iku->judul_ikk.') - '.$iku->keterangan_ikk }}</option>
                                    @endforeach
                                </select>
                                <div>
                                    @if ($errors->has('ikk_pimpinan_id'))
                                        <small class="form-text text-danger">{{ $errors->first('ikk_pimpinan_id') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Keterangan IKK</label>
                                <textarea name="keterangan_ikk" id="keterangan_ikk" disabled class="form-control" id="" cols="30" rows="3"></textarea>
                                <div>
                                    @if ($errors->has('keterangan_ikk'))
                                        <small class="form-text text-danger">{{ $errors->first('keterangan_ikk') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Isi SKP</label>
                                <textarea name="isi_ikk" id="isi_ikk"  class="form-control" id="" cols="30" rows="3"></textarea>
                                <div>
                                    @if ($errors->has('isi_ikk'))
                                        <small class="form-text text-danger">{{ $errors->first('isi_ikk') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Target SKP</label>
                                <textarea name="target_ikk" id="target_ikk"  class="form-control" id="" cols="30" rows="3"></textarea>
                                <div>
                                    @if ($errors->has('target_ikk'))
                                        <small class="form-text text-danger">{{ $errors->first('target_ikk') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Realisasi Berdasarkan Bukti Dukung</label>
                                <textarea name="realisasi_bukti_dukung" id="realisasi_bukti_dukung"  class="form-control" id="" cols="30" rows="3"></textarea>
                                <div>
                                    @if ($errors->has('realisasi_bukti_dukung'))
                                        <small class="form-text text-danger">{{ $errors->first('realisasi_bukti_dukung') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">Umpan Balik Berkelanjutan Berdasarkan Bukti Dukung</label>
                                <textarea name="umpan_balik_berkelanjutan" id="umpan_balik_berkelanjutan"  class="form-control" id="" cols="30" rows="2"></textarea>
                                <div>
                                    @if ($errors->has('umpan_balik_berkelanjutan'))
                                        <small class="form-text text-danger">{{ $errors->first('umpan_balik_berkelanjutan') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">Hasil Kerja</label>
                                <select name="angka" id="angka" class="form-control">
                                    <option disabled selected></option>
                                    <option value="1">Dibawah Ekspektasi</option>
                                    <option value="2">Sesuai Ekspektasi</option>
                                    <option value="3">Diatas Ekspektasi</option>
                                </select>
                                <div>
                                    @if ($errors->has('angka'))
                                        <small class="form-text text-danger">{{ $errors->first('angka') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <a href="{{ route('tendik.skp') }}" class="btn btn-warning btn-sm" style="color: white"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
                                <button type="reset" name="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i>&nbsp;Ulangi</button>
                                <button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp;Simpan</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('change','#ikk_pimpinan_id',function(){
            var ikk_pimpinan_id = $(this).val();
            $.ajax({
            type :'get',
            url: "{{ url('tendik/manajemen_data_skp/cari_ikk') }}",
            data:{'ikk_pimpinan_id':ikk_pimpinan_id},
                success:function(data){
                    $('#keterangan_ikk').val(data.keterangan_ikk);
                },
                    error:function(){
                }
            });
        });

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
    </script>
@endpush
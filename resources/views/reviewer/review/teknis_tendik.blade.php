@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;DASHBOARD
@endsection
@section('user-login')
    {{ Auth::user()->nama_lengkap }}
@endsection
@section('halaman')
    Halaman Reviewer
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
    @include('reviewer/sidebar')
@endsection
@section('user')
    <!-- User Account Menu -->
    <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <i class="fa fa-user"></i>&nbsp;
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{ Auth::user()->nama_lengkap }}</span>
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
        #chartdivperjabatandosen {
            width: 90%;
            height: 350px;
        }
        #chartdivperjk {
            width: 90%;
            height: 350px;
        }
        #chartdivdosenpergolongan {
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
                <h3 class="box-title"><i class="fa fa-calendar-times-o"></i>&nbsp;Indikator Penilaian</h3>
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
                <div class="col-md-12 table-responsive">
                    @if (Auth::user()->reviewerTeknisTendik()->get()->count() < 1)
                        <div class="alert alert-danger">Mohon Maaf, Anda Bukan Reviewer Aspek Teknis Tendik Berdasarkan Indikator Badan Penjamin Mutu</div>
                    @else
                        <table class="table table-striped table-hover" id="table" style="width:100%;">
                            <form action="{{ route('reviewer.penilaian_teknis.post') }}" method="POST">
                                {{ csrf_field() }} {{ method_field('POST') }}
                                <tr>
                                    <th>Pilih Dosen/Tendik</th>
                                    <td>
                                        <select name="pegawai_id" id="" class="form-control" required>
                                            <option disabled selected></option>
                                            @foreach ($pegawais as $pegawai)
                                                <option value="{{ $pegawai['id'] }}">{{ $pegawai['nama_pegawai'] }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @foreach ($babs as $index=>$bab)
                                    <tr>
                                        <th rowspan="{{ $bab->indikators()->get()->count() +1 }}"> {{ $index+1 }} </th>
                                        <th rowspan="{{ $bab->indikators()->get()->count() +1 }}">{{ $bab->nama_bab }}</th>
    
                                        @foreach ($bab->indikators()->get() as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->indikator }}
                                                </td>
                                                <td>
                                                    {{ $item->keterangan }}
                                                </td>
                                                <td style="width: 10%">
                                                    <input type="hidden" name="indikator_id{{ $item->id }}" value="{{ $item->id }}">
                                                    <select name="nilai{{ $item->id }}" class="form-control" id="" required>
                                                        <option disabled selected></option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4"></td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <button type="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-close"></i>&nbsp; Reset</button>
                                                </td>                                            
                                                <td>
                                                    <button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp; Simpan</button>    
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </form>
                        </table>
                    @endif
                    
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
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

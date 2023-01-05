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
    <div class="callout callout-info">
        <h4>Selamat Datang <b>{{ Auth::guard('tendik')->user()->nama_tendik }}</b></h4>
        <p>
            Aplikasi Evaluasi Mutu SDM adalah aplikasi yang digunakan untuk melakukan proses evaluasi mutu sumber daya manusia perguruan tinggi, dalam hal ini adalah Tenaga Pendidik (Dosen), dan Tenaga Kependidikan (Tendik)
            <br>
            <i><b>Catatan</b>: Untuk keamanan, jangan lupa keluar setelah menggunakan aplikasi</i>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12 sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-user"></i>&nbsp;Data Tenaga Kependidikan</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover ">
                                <tr>
                                    <th>NIP</th>
                                    <th> : </th>
                                    <td>{{ Auth::guard('tendik')->user()->nip }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Tendik</th>
                                    <th> : </th>
                                    <td>{{ Auth::guard('tendik')->user()->nama_tendik }}</td>
                                </tr>

                                <tr>
                                    <th>Unit Kerja</th>
                                    <th> : </th>
                                    <td>{{ Auth::guard('tendik')->user()->unit->nama_unit }}</td>
                                </tr>
                              
                                <tr>
                                    <th>Jabatan</th>
                                    <th> : </th>
                                    <td>{{ Auth::guard('tendik')->user()->jabatan }}</td>
                                </tr>
                                <tr>
                                    <th>TMT PNS</th>
                                    <th> : </th>
                                    <td>{{ Auth::guard('tendik')->user()->tmt_cpns }}</td>
                                </tr>
                                <tr>
                                    <th>Pangkat</th>
                                    <th> : </th>
                                    <td>{{ Auth::guard('tendik')->user()->pangkat }}</td>
                                </tr>
                                <tr>
                                    <th>Golongan</th>
                                    <th> : </th>
                                    <td>{{ Auth::guard('tendik')->user()->golongan }}</td>
                                </tr>
                                <tr>
                                    <th>Kelas Jabatan</th>
                                    <th> : </th>
                                    <td>{{ Auth::guard('tendik')->user()->kelas_jabatan }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive : true,
            });
        } );
    </script>
@endpush

<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('operator_unit.dashboard') }}">
    <a href="{{ route('operator_unit.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('operator_unit.tendik') }} active">
    <a href="{{ route('operator_unit.tendik') }}">
        <i class="fa fa-user"></i> <span>Penilaian Kinerja Dosen</span>
    </a>
</li>

<li class="{{ set_active('operator_unit.tendik') }}">
    <a href="{{ route('operator_unit.tendik') }}">
        <i class="fa fa-user-circle"></i> <span>Penilaian Kinerja Tendik</span>
    </a>
</li>

<li class="header" style="font-weight:bold;">Laporan Kinerja Dosen</li>
<li class="{{ set_active('operator_unit.tendik') }} ">
    <a href="{{ route('operator_unit.tendik') }}">
        <i class="fa fa-file-o"></i> <span>Formulir Kinerja Dosen </span>
    </a>
</li>
<li class="{{ set_active('operator_unit.tendik') }}">
    <a href="{{ route('operator_unit.tendik') }}">
        <i class="fa fa-file-pdf-o"></i> <span>Lembar Penilaian Dosen </span>
    </a>
</li>
<li class="{{ set_active('operator_unit.tendik') }}">
    <a href="{{ route('operator_unit.tendik') }}">
        <i class="fa fa-file-excel-o"></i> <span>Instrumen Penilaian Dosen </span>
    </a>
</li>
<li class="{{ set_active('operator_unit.tendik') }}">
    <a href="{{ route('operator_unit.tendik') }}">
        <i class="fa fa-file-word-o"></i> <span>Penilaian Akhir Dosen </span>
    </a>
</li>

<li class="header" style="font-weight:bold;">Laporan Kinerja Tendik</li>
<li class="{{ set_active('operator_unit.tendik') }} ">
    <a href="{{ route('operator_unit.tendik') }}">
        <i class="fa fa-file-excel-o"></i> <span>Formulir Kinerja Tendik </span>
    </a>
</li>
<li class="{{ set_active('operator_unit.tendik') }}">
    <a href="{{ route('operator_unit.tendik') }}">
        <i class="fa fa-file-o"></i> <span>Lembar Penilaian Tendik </span>
    </a>
</li>
<li class="{{ set_active('operator_unit.tendik') }}">
    <a href="{{ route('operator_unit.tendik') }}">
        <i class="fa fa-file-pdf-o"></i> <span>Instrumen Penilaian Tendik </span>
    </a>
</li>
<li class="{{ set_active('operator_unit.tendik') }}">
    <a href="{{ route('operator_unit.tendik') }}">
        <i class="fa fa-file-excel-o"></i> <span>Penilaian Akhir Tendik </span>
    </a>
</li>


<li class="header" style="font-weight:bold;">Keluar Aplikasi</li>
<li style="padding-left:2px;">
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off text-danger"></i><span>Logout</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</li>

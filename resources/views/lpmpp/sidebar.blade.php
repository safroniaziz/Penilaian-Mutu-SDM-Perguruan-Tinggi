<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('lpmpp.dashboard') }}">
    <a href="{{ route('lpmpp.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="treeview {{ set_active([
                                'lpmpp.fakultas','lpmpp.upt','lpmpp.lembaga','lpmpp.prodi',
                                'lpmpp.fakultas.add','lpmpp.fakultas.edit',
                                'lpmpp.lembaga.add','lpmpp.lembaga.edit',
                                'lpmpp.upt.add','lpmpp.upt.edit',
                                'lpmpp.prodi.add','lpmpp.prodi.edit','lpmpp.prodi.detail_mahasiswa','lpmpp.prodi.detail_dosen'
                                ]) }}">
    <a href="#">
        <i class="fa fa-building-o"></i> <span>Manajemen Data Unit</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu " style="padding-left:25px;">
        <li class="{{ set_active(['lpmpp.fakultas','lpmpp.fakultas.add','lpmpp.fakultas.edit']) }}"><a href="{{ route('lpmpp.fakultas') }}"><i class="fa fa-calendar-times-o"></i>Fakultas</a></li>
        <li class="{{ set_active(['lpmpp.lembaga','lpmpp.lembaga.add','lpmpp.lembaga.edit']) }}"><a href="{{ route('lpmpp.lembaga') }}"><i class="fa fa-clone"></i>Lembaga</a></li>
        <li class="{{ set_active(['lpmpp.upt','lpmpp.upt.add','lpmpp.upt.edit']) }}"><a href="{{ route('lpmpp.upt') }}"><i class="fa fa-university"></i>Unit Pelayanan Terpadu</a></li>
        <li class="{{ set_active(['lpmpp.prodi','lpmpp.prodi.add','lpmpp.prodi.edit','lpmpp.prodi.detail_mahasiswa','lpmpp.prodi.detail_dosen']) }}"><a href="{{ route('lpmpp.prodi') }}"><i class="fa fa-calendar"></i>Program Studi</a></li>
    </ul>
</li>

<li class="treeview {{ set_active(['lpmpp.dosen','lpmpp.tendik','lpmpp.dosen.add','lpmpp.dosen.edit','lpmpp.tendik.add','lpmpp.tendik.edit']) }}">
    <a href="#">
        <i class="fa fa-users"></i> <span>Manajemen Data SDM</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu " style="padding-left:25px;">
        <li class="{{ set_active(['lpmpp.dosen','lpmpp.dosen.add','lpmpp.dosen.edit']) }}"><a href="{{ route('lpmpp.dosen') }}"><i class="fa fa-user"></i>Dosen</a></li>
        <li class="{{ set_active(['lpmpp.tendik','lpmpp.tendik.add','lpmpp.tendik.edit']) }}"><a href="{{ route('lpmpp.tendik') }}"><i class="fa fa-user"></i>Tenaga Kependidikan</a></li>
    </ul>
</li>

<li class="{{ set_active('lpmpp.profil') }}">
    <a href="{{ route('lpmpp.profil') }}">
        <i class="fa fa-user"></i> <span>Profil Saya</span>
    </a>
</li>

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

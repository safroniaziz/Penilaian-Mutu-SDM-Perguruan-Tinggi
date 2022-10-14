<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('operator_unit.dashboard') }}">
    <a href="{{ route('operator_unit.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="treeview {{ set_active([
                                'operator_unit.fakultas','operator_unit.upt','operator_unit.lembaga','operator_unit.uot','operator_unit.prodi',
                                'operator_unit.fakultas.add','operator_unit.fakultas.edit',
                                'operator_unit.lembaga.add','operator_unit.lembaga.edit',
                                'operator_unit.upt.add','operator_unit.upt.edit',
                                'operator_unit.prodi.add','operator_unit.prodi.edit',
                                ]) }}">
    <a href="#">
        <i class="fa fa-building-o"></i> <span>Manajemen Data Unit</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu " style="padding-left:25px;">
        <li class="{{ set_active(['operator_unit.fakultas','operator_unit.fakultas.add','operator_unit.fakultas.edit']) }}"><a href="{{ route('operator_unit.fakultas') }}"><i class="fa fa-calendar-times-o"></i>Fakultas</a></li>
        <li class="{{ set_active(['operator_unit.lembaga','operator_unit.lembaga.add','operator_unit.lembaga.edit']) }}"><a href="{{ route('operator_unit.lembaga') }}"><i class="fa fa-clone"></i>Lembaga</a></li>
        <li class="{{ set_active(['operator_unit.upt','operator_unit.upt.add','operator_unit.upt.edit']) }}"><a href="{{ route('operator_unit.upt') }}"><i class="fa fa-university"></i>Unit Pelayanan Terpadu</a></li>
        <li class="{{ set_active(['operator_unit.prodi','operator_unit.prodi.add','operator_unit.prodi.edit']) }}"><a href="{{ route('operator_unit.prodi') }}"><i class="fa fa-calendar"></i>Program Studi</a></li>
    </ul>
</li>

<li class="treeview {{ set_active(['operator_unit.dosen','operator_unit.tendik','operator_unit.dosen.add','operator_unit.dosen.edit','operator_unit.tendik.add','operator_unit.tendik.edit']) }}">
    <a href="#">
        <i class="fa fa-users"></i> <span>Manajemen Data SDM</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu " style="padding-left:25px;">
        <li class="{{ set_active(['operator_unit.dosen','operator_unit.dosen.add','operator_unit.dosen.edit']) }}"><a href="{{ route('operator_unit.dosen') }}"><i class="fa fa-user"></i>Dosen</a></li>
        <li class="{{ set_active(['operator_unit.tendik','operator_unit.tendik.add','operator_unit.tendik.edit']) }}"><a href="{{ route('operator_unit.tendik') }}"><i class="fa fa-user"></i>Tenaga Kependidikan</a></li>
    </ul>
</li>

<li class="{{ set_active('operator_unit.profil') }}">
    <a href="{{ route('operator_unit.profil') }}">
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

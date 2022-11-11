<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('operator_prodi.dashboard') }}">
    <a href="{{ route('operator_prodi.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('operator_prodi.dosen') }}">
    <a href="{{ route('operator_prodi.dosen') }}">
        <i class="fa fa-user-circle"></i> <span>Manajemen Data Dosen</span>
    </a>
</li>

<li class="treeview {{ set_active(['operator_prodi.bkd_pendidikan','operator_prodi.bkd_penelitian','operator_prodi.bkd_pengabdian','operator_prodi.bkd_tridharma','operator_prodi.bkd_profesor']) }}">
    <a href="#">
        <i class="fa fa-graduation-cap"></i> <span>Beban Kinerja Dosen</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu " style="padding-left:25px;">
        <li class="{{ set_active('operator_prodi.bkd_pendidikan') }}"><a href="{{ route('operator_prodi.bkd_pendidikan') }}"><i class="fa fa-laptop"></i>Bidang Pendidikan</a></li>
        <li class="{{ set_active('operator_prodi.bkd_penelitian') }}"><a href="{{ route('operator_prodi.bkd_penelitian') }}"><i class="fa fa-laptop"></i>Bidang Penelitian</a></li>
        <li class="{{ set_active('operator_prodi.bkd_pengabdian') }}"><a href="{{ route('operator_prodi.bkd_pengabdian') }}"><i class="fa fa-laptop"></i>Bidang Pengabdian</a></li>
        <li class="{{ set_active('operator_prodi.bkd_tridharma') }}"><a href="{{ route('operator_prodi.bkd_tridharma') }}"><i class="fa fa-laptop"></i>Bidang Tri Dharma</a></li>
        <li class="{{ set_active('operator_prodi.bkd_profesor') }}"><a href="{{ route('operator_prodi.bkd_profesor') }}"><i class="fa fa-laptop"></i>Bidang Profesor</a></li>
    </ul>
</li>

<li class="{{ set_active('operator_prodi.profil') }}">
    <a href="{{ route('operator_prodi.profil') }}">
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

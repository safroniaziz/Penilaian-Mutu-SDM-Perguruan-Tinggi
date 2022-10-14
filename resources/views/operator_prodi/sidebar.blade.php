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

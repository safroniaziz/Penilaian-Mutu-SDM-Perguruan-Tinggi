<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('dosen.dashboard') }}">
    <a href="{{ route('dosen.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('dosen.skp') }}">
    <a href="{{ route('dosen.skp') }}">
        <i class="fa fa-file-excel-o"></i> <span>Manajemen Data SKP</span>
    </a>
</li>

<li style="padding-left:2px;">
    <a class="dropdown-item" href="{{ route('auth_logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off text-danger"></i><span>Logout</span>
    </a>

    <form id="logout-form" action="{{ route('auth_logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</li>

<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('operator_unit.dashboard') }}">
    <a href="{{ route('operator_unit.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('operator_unit.tendik') }}">
    <a href="{{ route('operator_unit.tendik') }}">
        <i class="fa fa-user-circle"></i> <span>Manajemen Data Tendik</span>
    </a>
</li>

<li class="{{ set_active('operator_unit.formulir') }}">
    <a href="{{ route('operator_unit.formulir') }}">
        <i class="fa fa-wpforms"></i> <span>Formulir Sasaran Kerja</span>
    </a>
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

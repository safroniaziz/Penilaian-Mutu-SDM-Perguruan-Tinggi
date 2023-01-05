<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('reviewer.dashboard') }}">
    <a href="{{ route('reviewer.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('reviewer.penilaian_banpt_dosen') }}">
    <a href="{{ route('reviewer.penilaian_banpt_dosen') }}">
        <i class="fa fa-check-circle"></i> <span>Review Mutu BAN-PT</span>
    </a>
</li>

<li class="header" style="font-weight:bold;">REVIEW TENDIK</li>
<li class="{{ set_active('reviewer.penilaian_teknis') }}">
    <a href="{{ route('reviewer.penilaian_teknis') }}">
        <i class="fa fa-check-circle"></i> <span>Indikator Aspek Teknis</span>
    </a>
</li>

<li class="{{ set_active('reviewer.penilaian_manajerial') }}">
    <a href="{{ route('reviewer.penilaian_manajerial') }}">
        <i class="fa fa-check-circle"></i> <span>Indikator Aspek Manajerial</span>
    </a>
</li>

<li class="{{ set_active('reviewer.penilaian_banpt_tendik') }}">
    <a href="{{ route('reviewer.penilaian_banpt_tendik') }}">
        <i class="fa fa-check-circle"></i> <span>Indikator BAN-PT Tendik</span>
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

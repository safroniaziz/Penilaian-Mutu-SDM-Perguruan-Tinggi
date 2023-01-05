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
<li class="treeview {{ set_active(['lpmpp.babIndikator','lpmpp.indikator','lpmpp.babIndikator.add','lpmpp.babIndikator.edit','lpmpp.indikator.add','lpmpp.indikator.edit','lpmpp.reviewer_indikator_banpt','lpmpp.reviewer_indikator_banpt.add','lpmpp.reviewer_indikator_banpt.edit']) }}">
    <a href="#">
        <i class="fa fa-list"></i> <span>Indikator Mutu BAN-PT</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu " style="padding-left:25px;">
        <li class="{{ set_active(['lpmpp.babIndikator','lpmpp.babIndikator.add','lpmpp.babIndikator.edit']) }}"><a href="{{ route('lpmpp.babIndikator') }}"><i class="fa fa-user"></i>Bab Indikator Penilaian</a></li>
        <li class="{{ set_active(['lpmpp.indikator','lpmpp.indikator.add','lpmpp.indikator.edit']) }}"><a href="{{ route('lpmpp.indikator') }}"><i class="fa fa-user"></i>Indikator Penilaian</a></li>
        <li class="{{ set_active(['lpmpp.reviewer_indikator_banpt','lpmpp.reviewer_indikator_banpt.add','lpmpp.reviewer_indikator_banpt.edit']) }}"><a href="{{ route('lpmpp.reviewer_indikator_banpt') }}"><i class="fa fa-user"></i>Reviewer Mutu BAN-PT</a></li>
    </ul>
</li>

<li class="treeview {{ set_active(['lpmpp.KriteriaTendikBpmAspekTeknis','lpmpp.IndikatorTendikBpmAspekTeknis','lpmpp.KriteriaTendikBpmAspekTeknis.add','lpmpp.KriteriaTendikBpmAspekTeknis.edit','lpmpp.IndikatorTendikBpmAspekTeknis.add','lpmpp.IndikatorTendikBpmAspekTeknis.edit','lpmpp.reviewer_teknis','lpmpp.reviewer_teknis.add','lpmpp.reviewer_teknis.edit']) }}">
    <a href="#">
        <i class="fa fa-list-alt"></i> <span>Kriteria Aspek Teknis</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu " style="padding-left:25px;">
        <li class="{{ set_active(['lpmpp.KriteriaTendikBpmAspekTeknis','lpmpp.KriteriaTendikBpmAspekTeknis.add','lpmpp.KriteriaTendikBpmAspekTeknis.edit']) }}"><a href="{{ route('lpmpp.KriteriaTendikBpmAspekTeknis') }}"><i class="fa fa-user"></i>Kriteria Aspek Teknis</a></li>
        <li class="{{ set_active(['lpmpp.IndikatorTendikBpmAspekTeknis','lpmpp.IndikatorTendikBpmAspekTeknis.add','lpmpp.IndikatorTendikBpmAspekTeknis.edit']) }}"><a href="{{ route('lpmpp.IndikatorTendikBpmAspekTeknis') }}"><i class="fa fa-user"></i>Indikator Aspek Teknis</a></li>
        <li class="{{ set_active(['lpmpp.reviewer_teknis','lpmpp.reviewer_teknis.add','lpmpp.reviewer_teknis.edit']) }}"><a href="{{ route('lpmpp.reviewer_teknis') }}"><i class="fa fa-user"></i>Reviewer Indikator Teknis</a></li>
    </ul>
</li>

<li class="treeview {{ set_active(['lpmpp.KriteriaTendikBpmAspekManajerial','lpmpp.IndikatorTendikBpmAspekManajerial','lpmpp.KriteriaTendikBpmAspekManajerial.add','lpmpp.KriteriaTendikBpmAspekManajerial.edit','lpmpp.IndikatorTendikBpmAspekManajerial.add','lpmpp.IndikatorTendikBpmAspekManajerial.edit','lpmpp.reviewer_manajerial','lpmpp.reviewer_manajerial.add','lpmpp.reviewer_manajerial.edit']) }}">
    <a href="#">
        <i class="fa fa-check-circle"></i> <span>Kriteria Aspek Manajerial</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu " style="padding-left:25px;">
        <li class="{{ set_active(['lpmpp.KriteriaTendikBpmAspekManajerial','lpmpp.KriteriaTendikBpmAspekManajerial.add','lpmpp.KriteriaTendikBpmAspekManajerial.edit']) }}"><a href="{{ route('lpmpp.KriteriaTendikBpmAspekManajerial') }}"><i class="fa fa-user"></i>Kriteria Aspek Manajerial</a></li>
        <li class="{{ set_active(['lpmpp.IndikatorTendikBpmAspekManajerial','lpmpp.IndikatorTendikBpmAspekManajerial.add','lpmpp.IndikatorTendikBpmAspekManajerial.edit']) }}"><a href="{{ route('lpmpp.IndikatorTendikBpmAspekManajerial') }}"><i class="fa fa-user"></i>Indikator Aspek Manajerial</a></li>
        <li class="{{ set_active(['lpmpp.reviewer_manajerial','lpmpp.reviewer_manajerial.add','lpmpp.reviewer_manajerial.edit']) }}"><a href="{{ route('lpmpp.reviewer_manajerial') }}"><i class="fa fa-user"></i>Reviewer Indikator Manajerial</a></li>

    </ul>
</li>

<li class="treeview {{ set_active(['lpmpp.tendik_ban_pt','lpmpp.reviewer_ban_pt_tendik','lpmpp.tendik_ban_pt.add','lpmpp.tendik_ban_pt.edit','lpmpp.reviewer_ban_pt_tendik.add','lpmpp.reviewer_ban_pt_tendik.edit']) }}">
    <a href="#">
        <i class="fa fa-info-circle"></i> <span>Kriteria BAN-PT Tendik</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu " style="padding-left:25px;">
        <li class="{{ set_active(['lpmpp.tendik_ban_pt','lpmpp.tendik_ban_pt.add','lpmpp.tendik_ban_pt.edit']) }}"><a href="{{ route('lpmpp.tendik_ban_pt') }}"><i class="fa fa-user"></i>Indikator BAN-PT Tendik</a></li>
        <li class="{{ set_active(['lpmpp.reviewer_ban_pt_tendik','lpmpp.reviewer_ban_pt_tendik.add','lpmpp.reviewer_ban_pt_tendik.edit']) }}"><a href="{{ route('lpmpp.reviewer_ban_pt_tendik') }}"><i class="fa fa-user"></i>Reviewer BAN-PT Tendik</a></li>
    </ul>
</li>

<li class="{{ set_active('lpmpp.reviewers') }}">
    <a href="{{ route('lpmpp.reviewers') }}">
        <i class="fa fa-users"></i> <span>Manajemen Data Reviewer</span>
    </a>
</li>

<li class="header" style="font-weight:bold;">LAPORAN</li>
<li class="treeview {{ set_active(['lpmpp.ban_pt_dosen','lpmpp.laporan_teknis','lpmpp.ban_pt_dosen.add','lpmpp.ban_pt_dosen.edit','lpmpp.laporan_teknis.add','lpmpp.laporan_teknis.edit','lpmpp.laporan_manajerial','lpmpp.laporan_manajerial.add','lpmpp.laporan_manajerial.edit','lpmpp.laporan_banpt_tendik','lpmpp.laporan_banpt_tendik.add','lpmpp.laporan_banpt_tendik.edit']) }}">
    <a href="#">
        <i class="fa fa-check-circle"></i> <span>Laporan Hasil Review</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu " style="padding-left:25px;">
        <li class="{{ set_active(['lpmpp.ban_pt_dosen']) }}"><a href="{{ route('lpmpp.ban_pt_dosen') }}"><i class="fa fa-user"></i>BAN-PT Dosen</a></li>
        <li class="{{ set_active(['lpmpp.laporan_teknis','lpmpp.laporan_teknis.add','lpmpp.laporan_teknis.edit']) }}"><a href="{{ route('lpmpp.laporan_teknis') }}"><i class="fa fa-user"></i>Aspek Teknis Tendik</a></li>
        <li class="{{ set_active(['lpmpp.laporan_manajerial','lpmpp.laporan_manajerial.add','lpmpp.laporan_manajerial.edit']) }}"><a href="{{ route('lpmpp.laporan_manajerial') }}"><i class="fa fa-user"></i>Aspek Manajerial Tendik</a></li>
        <li class="{{ set_active(['lpmpp.laporan_banpt_tendik','lpmpp.laporan_banpt_tendik.add','lpmpp.laporan_banpt_tendik.edit']) }}"><a href="{{ route('lpmpp.laporan_banpt_tendik') }}"><i class="fa fa-user"></i>Indikator BAN-PT Tendik</a></li>
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

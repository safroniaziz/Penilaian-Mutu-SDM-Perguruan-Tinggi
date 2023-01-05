<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Evaluasi Pegawai</title>
    <meta name="description" content="Sistem Informasi Remunerasi, BKD, SPK Terintegrasi">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="shortcut icon" href="{{ asset('assets/logo/logo_unib.png') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    /* * { */
        /* line-height: ; */
    /* } */

    @page{
        margin: 1cm 2cm 2cm 1.3cm;
    }

    .tb, .th, .td {
        border-collapse: collapse;
        font-size: 12px; 
    }

    .page-break {
        page-break-after: always;
    }
</style>
<body>
    <div class="row">
        <div class="col-md-12">
            <table style="width: 100%; margin-bottom:25px !important;">
                <tr>
                    <td class="td" style="text-align: center">EVALUASI KINERJA PEGAWAI</td>
                </tr>
                <tr>
                    <td class="td" style="text-align: center">PENDEKATAN HASIL KERJA <b>KUANTITATIF</b></td>
                </tr>
                <tr>
                    <td class="td" style="text-align: center">
                        BAGI PEJABAT ADMINISTRASI DAN PEJABAT FUNGSIONAL
                    </td>
                </tr>
            </table>
            <table style="width: 100%" class="tb">
                <tr>
                    <td class="td">UNIVERSITAS BENGKULU</td>
                    <td class="td" style="text-transform: uppercase; text-align:right">PERIODE PENILAIAN, {{ Carbon\Carbon::parse($tendik->skp->periode_awal)->isoFormat('D MMMM') }} SD {{ Carbon\Carbon::parse($tendik->skp->periode_akhir)->isoFormat('D MMMM') }}</td>
                </tr>
            </table>
            <table width=100% style="margin-bottom:5px;" class="tb">
                <tr style="background:#bcd6ee">
                    <td style="border: 1px solid black;" class="td text-center" width="3%">NO</td>
                    <td style="border: 1px solid black;" class="td" width=48% colspan="3" colspan="2" class="text-center">PEGAWAI YANG DINILAI</td>
                    <td style="border: 1px solid black; width:10px !important;" class="td text-center"  align="center">NO</td>
                    <td style="border: 1px solid black;" class="td" width=48% colspan="2" class="text-center">PEJABAT PENILAI KINERJA</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;" class="td text-center">1</td>
                    <td style="border: 1px solid black; width:20%" class="td">NAMA</td>
                    <td style="border: 1px solid black;" class="td">{{ $tendik->nama_tendik }}</td>
                    <td style="border: 1px solid black;" class="td text-center">1</td>
                    <td style="border: 1px solid black;" class="td">NAMA</td>
                    <td style="border: 1px solid black;" class="td">
                        @if (strlen(Auth::guard('tendik')->user()->skp->pejabat_penilai_id) > 5)
                            {{ $tendik->skp->penilaiDosen->gelar_depan.' '.$tendik->skp->penilaiDosen->nama_dosen.', '.$tendik->skp->penilaiDosen->gelar_belakang }}
                        @else
                            {{ $tendik->skp->penilai->nama_tendik }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td style="border: 1px solid black;" class="td text-center">2</td>
                    <td style="border: 1px solid black;" class="td">NIP</td>
                    <td style="border: 1px solid black;" class="td">{{ $tendik->id }}</td>
                    <td style="border: 1px solid black;" class="td text-center">2</td>
                    <td style="border: 1px solid black;" class="td">NIP</td>
                    <td style="border: 1px solid black;" class="td">
                        @if (strlen(Auth::guard('tendik')->user()->skp->pejabat_penilai_id) > 5)
                            {{ $tendik->skp->penilaiDosen->id }}
                        @else
                            {{ $tendik->skp->penilai->nip }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td style="border: 1px solid black;" class="td text-center">3</td>
                    <td style="border: 1px solid black;" class="td">PANGKAT/GOL.RUANG</td>
                    <td style="border: 1px solid black;" class="td">{{ $tendik->pangkat != "" ? $tendik->pangkat : '-'.'/'.$tendik->golongan }}</td>
                    <td style="border: 1px solid black;" class="td text-center">3</td>
                    <td style="border: 1px solid black;" class="td">PANGKAT/GOL.RUANG</td>
                    <td style="border: 1px solid black;" class="td">
                        @if (strlen(Auth::guard('tendik')->user()->skp->pejabat_penilai_id) > 5)
                            {{ $tendik->skp->penilaiDosen->pangkat != "" ? $tendik->skp->penilaiDosen->pangkat : '-'.'/'.$tendik->skp->penilaiDosen->golongan }}
                        @else
                            {{ $tendik->skp->penilai->pangkat != "" ? $tendik->skp->penilai->pangkat : '-'.'/'.$tendik->skp->penilai->golongan }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td style="border: 1px solid black;" class="td text-center">3</td>
                    <td style="border: 1px solid black;" class="td">JABATAN</td>
                    <td style="border: 1px solid black;" class="td">{{ $tendik->jabatan != "Tidak Ada Data" ? $tendik->jabatan : '-' }}</td>
                    <td style="border: 1px solid black;" class="td text-center">3</td>
                    <td style="border: 1px solid black;" class="td">JABATAN</td>
                    <td style="border: 1px solid black;" class="td">
                        @if (strlen(Auth::guard('tendik')->user()->skp->pejabat_penilai_id) > 5)
                            {{ $tendik->skp->penilaiDosen->jabatan_akademik != "Tidak Ada Data" ? $tendik->skp->penilaiDosen->jabatan_akademik : '-' }}
                        @else
                            {{ $tendik->skp->penilai->jabatan != "Tidak Ada Data" ? $tendik->skp->penilai->jabatan : '-' }}
                        @endif    
                    </td>
                </tr>
                <tr style="background:#bcd6ee">
                    <td colspan="6" style="border: 1px solid black;">
                        <b>CAPAIAN KINERJA ORGANISASI *</b>
                    </td>
                </tr>
                <tr style="background:#bcd6ee">
                    <td colspan="6" style="border: 1px solid black; text-transform:uppercase">
                        {{ $tendik->skp->capaian_kinerja_organisasi }}
                    </td>
                </tr>
                <tr style="background:#bcd6ee">
                    <td colspan="6" style="border: 1px solid black;">
                        <b>POLA DISTRIBUSI</b>
                    </td>
                </tr>
                <tr style="background:#bcd6ee">
                    <td colspan="6" style="border: 1px solid black; padding:3px 0px !important;" class="text-center">
                        @if ($tendik->skp->capaian_kinerja_organisasi == "istimewa")
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/chart/sangat_baik.png'))) }}" alt="">
                        @elseif ($tendik->skp->capaian_kinerja_organisasi == "baik")
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/chart/baik.png'))) }}" alt="">
                        @elseif ($tendik->skp->capaian_kinerja_organisasi == "butuh_perbaikan")
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/chart/butuh_perbaikan.png'))) }}" alt="">
                        @elseif ($tendik->skp->capaian_kinerja_organisasi == "kurang")
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/chart/kurang.png'))) }}" alt="">
                        @elseif ($tendik->skp->capaian_kinerja_organisasi == "sangat_kurang")
                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/chart/sangat_kurang.png'))) }}" alt="">
                        @endif
                    </td>
                </tr>
                <tr style="background:#bcd6ee">
                    <td colspan="2" style="border: 1px solid black;">
                        <b>HASIL KERJA</b>
                    </td>
                    <td rowspan="2" style="border: 1px solid black;" class="text-center">REALISASI BERDASARKAN BUKTI DUKUNG</td>
                    <td rowspan="2" style="border: 1px solid black; width:25%" class="text-center">UMPAN BALIK BERKELANJUTAN BERDASARKAN BUKTI DUKUNG</td>
                    <td rowspan="2" style="border: 1px solid black; background: #a9d18f !important; width:15%" class="text-center">
                        HASIL KERJA <br>
                        1-Dibawah Ekspektasi <br>
                        2-Sesuai Ekspektasi <br>
                        3-Diatas Ekspektasi <br>
                    </td>
                    <td rowspan="2" style="border: 1px solid black; background: #a9d18f !important; width:5%" class="text-center">
                        Angka
                    </td>
                </tr>
                <tr style="background:#bcd6ee">
                    <td colspan="2" style="border: 1px solid black;">
                        <b>A. UTAMA</b>
                    </td>
                </tr>
                @foreach ($tendik->skp->skpDetails()->get() as $index=> $item)
                    <tr>
                        <td style="border-top: 1px solid black;border-left: 1px solid black;" class="text-center">{{ $index+1 }}</td>
                        <td style="border: 1px solid black;">{{ $item->ikkPimpinan->keterangan_ikk }} <br>
                            <i>Ukuran keberhasilan/Indikator Kinerja Inividu, Target, dan Perspektif :</i> <br>
                            {{ $item->isi_ikk }}
                        </td>
                        <td style="border: 1px solid black;">{{ $item->realisasi_bukti_dukung }}</td>
                        <td style="border: 1px solid black;">{{ $item->umpan_balik_berkelanjutan }}</td>
                        <td style="border: 1px solid black;" class="text-center">
                            @if ($item->angka == "1")
                                DIBAWAH EKSPEKTASI
                            @elseif($item->angka == "2")
                                SESUAI EKSPEKTASI
                            @else
                                DIATAS EKSPEKTASI
                            @endif
                        </td>
                        <td style="border: 1px solid black;" class="text-center">
                            {{ $item->angka }}
                        </td>
                    </tr>
                @endforeach
                <tr style="background:#bcd6ee">
                    <td colspan="4" style="border: 1px solid black;">
                        <b>RATING HASIL KERJA</b>
                    </td>
                    <td rowspan="3" class="text-center" style="border: 1px solid black;"">
                        <b>Rekomendasi</b>
                    </td>
                    <td class="text-center" style="border: 1px solid black;"">
                        {{-- {{ $tendik->skp->jumlah_angka_angka/$tendik->skp->total_angka }} --}}
                        {{ $tendik->skp->rata_rata_angka }}
                    </td>
                </tr>
                <tr style="background:#bcd6ee;">
                    <td colspan="4" style="border: 1px solid black;">
                        @if ($tendik->skp->rating_hasil_kerja == "sesuai_ekspektasi")
                            SESUAI EKSPEKTASI
                        @elseif ($tendik->skp->rating_hasil_kerja == "diatas_ekspektasi")
                            DIATAS EKSPEKTASI
                        @else
                            DIBAWAH EKSPEKTASI
                        @endif
                    </td>
                    <td style="font-weight: bold; width:15%;border: 1px solid black;" rowspan="2" class="text-center">
                        @if ($tendik->skp->rata_rata_angka == 1)
                            DIBAWAH EKSPEKTASI
                        @elseif ($tendik->skp->rata_rata_angka == 1)
                            SESUAI EKSPEKTASI
                        @else
                            DIATAS EKSPEKTASI
                        @endif
                    </td>
                </tr>
                <tr style="background:#bcd6ee;">
                    <td colspan="4" style="border: 1px solid black;">
                        PERILAKU KERJA
                    </td>
                </tr>
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">1</td>
                    <td style="border: 1px solid black;" colspan="3">Berorientasi Pelayanan</td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">SESUAI EKSPEKTASI</td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">2</td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black; width:35% !important">- Memahami dan memenuhi kebutuhan masyarakat	 <br>
                        -Ramah, cekatan, solutif, dan dapat diandalkan <br>
                        - Melakukan perbaikan tiada henti
                    </td>
                    <td style="border: 1px solid black;">
                        <i>Ekspektasi Khusus Pimpinan:	<br> Sudah Baik dan Sesuai		</i>
                    </td>
                    <td style="border: 1px solid black;">
                        <i>Sudah Baik dan peneglolaan waktu sudah sesuai jadwal</i>
                    </td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">2</td>
                    <td style="border: 1px solid black;" colspan="3">Akuntabel									
                    </td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">SESUAI EKSPEKTASI</td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">2</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black; width:35% !important">- Melaksanakan tugas dengan jujur, bertanggungjawab, cermat, disiplin dan berintegritas tinggi	<br>				
                        - Menggunakan kekayaan dan barang milik negara secara bertanggungjawab, efektif, dan efisien					<br>
                        - Tidak menyalahgunakan kewenangan jabatan					
                        
                    </td>
                    <td style="border: 1px solid black;">
                        <i>Ekspektasi Khusus Pimpinan:	<br> Sudah Baik dan Sesuai		</i>
                    </td>
                    <td style="border: 1px solid black;">
                        <i>Sudah Baik dan peneglolaan waktu sudah sesuai jadwal</i>
                    </td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">3</td>
                    <td style="border: 1px solid black;" colspan="3">Kompeten									
                    </td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">SESUAI EKSPEKTASI</td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">2</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black; width:35% !important">
                        - Meningkatkan kompetensi diri untuk menjawab tantangan yang selalu berubah <br>					
                        - Membantu orang lain belajar					<br>
                        - Melaksanakan tugas dengan kualitas terbaik					

                    </td>
                    <td style="border: 1px solid black;">
                        <i>Ekspektasi Khusus Pimpinan:	<br> Sudah Baik dan Sesuai		</i>
                    </td>
                    <td style="border: 1px solid black;">
                        <i>Sudah Baik dan peneglolaan waktu sudah sesuai jadwal</i>
                    </td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">4</td>
                    <td style="border: 1px solid black;" colspan="3">Harmonis									
                    </td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">SESUAI EKSPEKTASI</td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">2</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black; width:35% !important">
                        - Menghargai setiap orang apapun latar belakangnya		<br>			
                        - Suka menolong orang lain					<br>
                        - Membangun lingkungan kerja yang kondusif					
				

                    </td>
                    <td style="border: 1px solid black;">
                        <i>Ekspektasi Khusus Pimpinan:	<br> Sudah Baik dan Sesuai		</i>
                    </td>
                    <td style="border: 1px solid black;">
                        <i>Sudah Baik dan peneglolaan waktu sudah sesuai jadwal</i>
                    </td>
                </tr>
                
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">5</td>
                    <td style="border: 1px solid black;" colspan="3">Loyal									
                    </td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">SESUAI EKSPEKTASI</td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">2</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black; width:35% !important">
                        - Memegang teguh ideologi Pancasila, Undang-Undang Dasar Negara Republik Indonesia Tahun 1945, setia kepada Negara Kesatuan Republik Indonesia serta pemerintahan yang sah		<br>			
                        - Menjaga nama baik sesama ASN, Pimpinan, Instansi, dan Negara					<br>
                        - Menjaga rahasia jabatan dan negara					
                    </td>
                    <td style="border: 1px solid black;">
                        <i>Ekspektasi Khusus Pimpinan:	<br> Sudah Baik dan Sesuai		</i>
                    </td>
                    <td style="border: 1px solid black;">
                        <i>Sudah Baik dan peneglolaan waktu sudah sesuai jadwal</i>
                    </td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">6</td>
                    <td style="border: 1px solid black;" colspan="3">Adaptif									
                    </td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">SESUAI EKSPEKTASI</td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">2</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black; width:35% !important">
                        - Cepat menyesuaikan diri menghadapi perubahan		<br>			
                        - Terus berinovasi dan mengembangkan kreativitas		<br>			
                        - Bertindak proaktif					
                    </td>
                    <td style="border: 1px solid black;">
                        <i>Ekspektasi Khusus Pimpinan:	<br> Sudah Baik dan Sesuai		</i>
                    </td>
                    <td style="border: 1px solid black;">
                        <i>Sudah Baik dan peneglolaan waktu sudah sesuai jadwal</i>
                    </td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">7</td>
                    <td style="border: 1px solid black;" colspan="3">Kolaboratif									
                    </td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">SESUAI EKSPEKTASI</td>
                    <td style="border: 1px solid black;" rowspan="2" class="text-center">2</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black; width:35% !important">
                        - Memberi kesempatan kepada berbagai pihak untuk berkontribusi <br>					
                        - Terbuka dalam bekerja sama untuk menghasilkan nilai tambah		<br>			
                        - Menggerakkan pemanfaatan berbagai sumberdaya untuk tujuan bersama					
                    </td>
                    <td style="border: 1px solid black;">
                        <i>Ekspektasi Khusus Pimpinan:	<br> Sudah Baik dan Sesuai		</i>
                    </td>
                    <td style="border: 1px solid black;">
                        <i>Sudah Baik dan peneglolaan waktu sudah sesuai jadwal</i>
                    </td>
                </tr>

                <tr style="background:#bcd6ee">
                    <td colspan="4" style="border: 1px solid black;">
                        <b>RATING PERILAKU KERJA</b>
                    </td>
                    <td rowspan="4" class="text-center" style="border: 1px solid black;"">
                        <b>Rekomendasi</b>
                    </td>
                    <td class="text-center" style="border: 1px solid black;"">
                        {{-- {{ $tendik->skp->jumlah_angka_angka/$tendik->skp->total_angka }} --}}
                        2
                    </td>
                </tr>
                <tr style="background:#bcd6ee;">
                    <td colspan="4" style="border: 1px solid black;">
                        @if ($tendik->skp->rating_perilaku_kerja == "sesuai_ekspektasi")
                            SESUAI EKSPEKTASI
                        @elseif ($tendik->skp->rating_perilaku_kerja == "diatas_ekspektasi")
                            DIATAS EKSPEKTASI
                        @else
                            DIBAWAH EKSPEKTASI
                        @endif
                    </td>
                    <td style="font-weight: bold; width:15%;border: 1px solid black;" rowspan="3" class="text-center">
                        SESUAI EKSPEKTASI
                    </td>
                </tr>
                <tr style="background:#bcd6ee">
                    <td colspan="4" style="border: 1px solid black;">
                        <b>PREDIKAT KINERJA PEGAWAI</b>
                    </td>
                </tr>
                <tr style="background:#bcd6ee">
                    <td colspan="4" style="border: 1px solid black;">
                        BAIK
                    </td>
                </tr>
            </table>

            <table  style="margin-top: 40px; width:100%" class="tb"> 
                <tr>
                    <td class="td"></td>
                    <td class="text-center td">
                        Bengkulu, {{ Carbon\Carbon::parse($tendik->skp->ttd_pejabat)->isoFormat('D MMMM Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="width:50% !important;" class="text-center td"></td>
                    <td class="text-center td">
                        Pejabat Penilai Kinerja
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 50px !important"></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center td">{{ $tendik->nama_tendik }}</td>
                    <td class="text-center td">
                        @if (strlen(Auth::guard('tendik')->user()->skp->pejabat_penilai_id) > 5)
                            {{ $tendik->skp->penilaiDosen->gelar_depan.'. '.$tendik->skp->penilaiDosen->nama_dosen.', '.$tendik->skp->penilaiDosen->gelar_belakang }}
                        @else
                            {{ $tendik->skp->penilai->nama_tendik }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-center td">NIP {{ $tendik->id }}</td>
                    <td class="text-center td">NIP 
                        @if (strlen(Auth::guard('tendik')->user()->skp->pejabat_penilai_id) > 5)
                            {{ $tendik->skp->penilaiDosen->id }}
                        @else
                            {{ $tendik->skp->penilai->nip }}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Laporan SKP Dosen</title>
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
                    <td class="td" style="text-align: center">SASARAN KINERJA PEGAWAI</td>
                </tr>
                <tr>
                    <td class="td" style="text-align: center">PENDEKATAN HASIL KERJA <b>KUALITATIF</b></td>
                </tr>
                <tr>
                    <td class="td" style="text-align: center">
                        BAGI PEJABAT PIMPINAN TINGGI DAN PIMPINAN UNIT KERJA MANDIRI
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
                    <td style="border: 1px solid black;" class="td text-center" width=3%>NO</td>
                    <td style="border: 1px solid black;" class="td" width=48% colspan="3" colspan="2">PEGAWAI YANG DINILAI</td>
                    <td style="border: 1px solid black;" class="td text-center" width=3% align="center">NO</td>
                    <td style="border: 1px solid black;" class="td" width=48% colspan="2">PEJABAT PENILAI KINERJA</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;" class="td text-center">1</td>
                    <td style="border: 1px solid black;" class="td">NAMA</td>
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
                        <b>HASIL KERJA</b>
                    </td>
                </tr>
                <tr style="background:#bcd6ee">
                    <td colspan="6" style="border: 1px solid black;">
                        <b>A. UTAMA</b>
                    </td>
                </tr>
                @foreach ($tendik->skp->skpDetails()->get() as $index=> $item)
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black;" class="text-center">{{ $index+1 }}</td>
                        <td style="border: 1px solid black;" colspan="5">({{ $item->ikkPimpinan->keterangan_ikk }})</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;" colspan="5">
                            <i>Ukuran keberhasilan/Indikator Kinerja Inividu, Target, dan Perspektif :</i> <br>
                            {{ $item->isi_ikk }}
                        </td>
                    </tr>
                @endforeach
                <tr style="background:#bcd6ee">
                    <td colspan="6" style="border: 1px solid black;">
                        <b>PERILAKU KERJA *</b>
                    </td>
                </tr>
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">1</td>
                    <td style="border: 1px solid black;" colspan="5">Berorientasi Pelayanan</td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">- Memahami dan memenuhi kebutuhan masyarakat	</td>
                    <td style="border: 1px solid black;" colspan="2">Ekspektasi Khusus Pimpinan:	
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">- Ramah, cekatan, solutif, dan dapat diandalkan	</td>
                    <td style="border: 1px solid black;" colspan="2" class="text-center">Sudah Baik dan Sesuai	</td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">- Melakukan perbaikan tiada henti	</td>
                    <td style="border: 1px solid black;" colspan="2">	</td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">2</td>
                    <td style="border: 1px solid black;" colspan="5">Akuntabel			
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">- Melaksanakan tugas dengan jujur, bertanggung jawab, cermat,
                        disiplin, dan berintegritas tinggi
                        </td>
                    <td style="border: 1px solid black;" colspan="2">Ekspektasi Khusus Pimpinan:	
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">- Menggunakan kekayaan dan barang milik negara secara bertanggung
                        jawab, efektif, dan efisien.
                            </td>
                    <td style="border: 1px solid black;" colspan="2" class="text-center">Sudah Baik dan Sesuai	</td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Tidak menyalahgunakan kewenangan jabatan	
                    </td>
                    <td style="border: 1px solid black;" colspan="2">	</td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">3</td>
                    <td style="border: 1px solid black;" colspan="5">Kompeten			
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">- Meningkatkan kompetensi diri untuk menjawab tantangan yang selalu
                        berubah
                        
                    <td style="border: 1px solid black;" colspan="2">Ekspektasi Khusus Pimpinan:	
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">- Membantu orang lain belajar	
                            </td>
                    <td style="border: 1px solid black;" colspan="2" class="text-center">Sudah Baik dan Sesuai	</td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Melaksanakan tugas dengan kualitas terbaik	
                    </td>
                    <td style="border: 1px solid black;" colspan="2">	</td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">4</td>
                    <td style="border: 1px solid black;" colspan="5">Harmonis			
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Menghargai setiap orang apapun latar belakangnya	
                    <td style="border: 1px solid black;" colspan="2">Ekspektasi Khusus Pimpinan:	
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Suka menolong orang lain	
                    </td>
                    <td style="border: 1px solid black;" colspan="2" class="text-center">Sudah Baik dan Sesuai	</td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Membangun lingkungan kerja yang kondusif	
                    </td>
                    <td style="border: 1px solid black;" colspan="2">	</td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">5</td>
                    <td style="border: 1px solid black;" colspan="5">Loyal
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                       - Memegang teguh ideologi Pancasila, Undang-Undang Dasar Negara
Republik Indonesia Tahun 1945, setia pada Negara Kesatuan Republik
Indonesia serta pemerintahan yang sah
                    <td style="border: 1px solid black;" colspan="2">Ekspektasi Khusus Pimpinan:	
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Menjaga nama baik sesama ASN, Pimpinan, Instansi, dan Negara	
                    </td>
                    <td style="border: 1px solid black;" colspan="2" class="text-center">Sudah Baik dan Sesuai	</td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Menjaga rahasia jabatan dan negara	
                    </td>
                    <td style="border: 1px solid black;" colspan="2">	</td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">6</td>
                    <td style="border: 1px solid black;" colspan="5">Adaptif
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Cepat menyesuaikan diri menghadapi perubahan	
                    <td style="border: 1px solid black;" colspan="2">Ekspektasi Khusus Pimpinan:	
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Terus berinovasi dan mengembangkan kreativitas	
                    </td>
                    <td style="border: 1px solid black;" colspan="2" class="text-center">Sudah Baik dan Sesuai	</td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Bertindak proaktif	
                    </td>
                    <td style="border: 1px solid black;" colspan="2">	</td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">7</td>
                    <td style="border: 1px solid black;" colspan="5">Kolaboratif
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Memberi kesempatan kepada berbagai pihak untuk berkontribusi	
                    <td style="border: 1px solid black;" colspan="2">Ekspektasi Khusus Pimpinan:	
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Terbuka dalam bekerja sama untuk menghasilkan nilai tambah	
                    </td>
                    <td style="border: 1px solid black;" colspan="2" class="text-center">Sudah Baik dan Sesuai	</td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid black; border-bottom:1px solid black;"></td>
                    <td style="border: 1px solid black;" colspan="3">
                        - Menggerakkan pemanfaatan berbagai sumberdaya untuk tujuan bersama
                    </td>
                    <td style="border: 1px solid black;" colspan="2">	</td>
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
                    <td style="width:50% !important;" class="text-center td">Pegawai yang Dinilai</td>
                    <td class="text-center td">
                        Pejabat Penilai Kinerja
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 100px !important"></td>
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
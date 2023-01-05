<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Catatan Nilai Kinerja</title>
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
        font-size: 11px; 
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
                    <td class="td" style="text-align: left">
                        <b>TIDAK ADA KEBERATAN NILAI KINERJA</b>
                    </td>
                </tr>
            </table>
            <table width=100% style="margin-bottom:5px;" class="tb" style="margin-bottom:0px;" class="tb">
                
                <tr >
                    <td colspan="4" class="text-center td">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/images/garuda.png'))) }}" width="100" alt="">
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center td">
                        DOKUMEN EVALUASI KINERJA PEGAWAI
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px"></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center td">
                        PERIODE*: TRIWULAN @if ($dosen->skp->triwulan == "1")
                            I/<s>II/III/IV-AKHIR</s>
                        @elseif ($dosen->skp->triwulan == "1")
                            <s>I/</s>II<s>/III/IV-AKHIR</s>
                        @elseif ($dosen->skp->triwulan == "1")
                            <s>I/II/</s>III/<s>IV-AKHIR</s>
                        @else
                            <s>I/II/III/</s>IV-AKHIR
                        @endif**
                    </td>
                </tr>
            </table>

            <hr style="border: none;height: 2px;background: black; margin-top:0; margin-bottom:0">
            
            <table width=100% style="margin-bottom:5px;" class="tb" style="margin-bottom:0px;">
                <tr>
                    <td class="td" colspan="2" >
                        KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, 
                    </td>
                    <td class="td" colspan="2" >
                        PERIODE PENILAIAN :
                    </td>
                </tr>
                <tr>
                    <td colspan="2">DAN TEKNOLOGI</td>
                    <td class="td" colspan="2" >
                        {{ Carbon\Carbon::parse($dosen->skp->periode_awal)->isoFormat('D MMMM') }} SD {{ Carbon\Carbon::parse($dosen->skp->periode_akhir)->isoFormat('D MMMM') }} TAHUN {{ Carbon\Carbon::parse($dosen->skp->periode_akhir)->isoFormat('Y') }}
                    </td>
                </tr>
                <tr style="background:#bcd6ee">
                    <td rowspan="6" style="width: 3%;border: 1px solid black;vertical-align: top;background:#bcd6ee" class="text-center td">1</td>
                    <td colspan="3" class="td" style="border: 1px solid black;">PEGAWAI YANG DINILAI</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">NAMA</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->gelar_depan.' '.$dosen->nama_dosen.', '.$dosen->gelar_belakang }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">NIP</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->id }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">PANGKAT/GOL.RUANG</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->pangkat != "" ? $dosen->pangkat : '-'.'/'.$dosen->golongan }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">JABATAN</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->jabatan_akademik }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">UNIT KERJA</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->prodi->unit->nama_unit }}</td>
                </tr>

                <tr style="background:#bcd6ee">
                    <td rowspan="6" style="width: 3%;border: 1px solid black;vertical-align: top;background:#bcd6ee" class="text-center">2</td>
                    <td colspan="3" class="td" style="border: 1px solid black;">PEJABAT PENILAI KINERJA</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">NAMA</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->penilai->gelar_depan.' '.$dosen->skp->penilai->nama_dosen.', '.$dosen->skp->penilai->gelar_belakang }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">NIP</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->penilai->id }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">PANGKAT/GOL.RUANG</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->penilai->pangkat != "" ? $dosen->skp->penilai->pangkat : '-'.'/'.$dosen->skp->penilai->golongan }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">JABATAN</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->penilai->jabatan_akademik }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">UNIT KERJA</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->penilai->prodi->unit->nama_unit }}</td>
                </tr>

                <tr style="background:#bcd6ee">
                    <td rowspan="6" style="width: 3%;border: 1px solid black;vertical-align: top;background:#bcd6ee" class="text-center">3</td>
                    <td colspan="3" class="td" style="border: 1px solid black;">ATASAN PEJABAT PENILAI KINERJA</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">NAMA</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->atasanPenilai->gelar_depan.' '.$dosen->skp->atasanPenilai->nama_dosen.', '.$dosen->skp->atasanPenilai->gelar_belakang }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">NIP</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->atasanPenilai->id }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">PANGKAT/GOL.RUANG</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->atasanPenilai->pangkat != "" ? $dosen->skp->atasanPenilai->pangkat : '-'.'/'.$dosen->skp->atasanPenilai->golongan }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">JABATAN</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->atasanPenilai->jabatan_akademik }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">UNIT KERJA</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->atasanPenilai->prodi->unit->nama_unit }}</td>
                </tr>

                <tr style="background:#bcd6ee">
                    <td rowspan="6" style="width: 3%;border: 1px solid black;vertical-align: top;background:#bcd6ee" class="text-center">2</td>
                    <td colspan="3" class="td" style="border: 1px solid black;">PEJABAT PENILAI KINERJA</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">NAMA</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->penilai->gelar_depan.' '.$dosen->skp->penilai->nama_dosen.', '.$dosen->skp->penilai->gelar_belakang }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">NIP</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->penilai->id }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">PANGKAT/GOL.RUANG</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->penilai->pangkat != "" ? $dosen->skp->penilai->pangkat : '-'.'/'.$dosen->skp->penilai->golongan }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">JABATAN</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->penilai->jabatan_akademik }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">UNIT KERJA</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">{{ $dosen->skp->penilai->prodi->unit->nama_unit }}</td>
                </tr>

                <tr style="background:#bcd6ee">
                    <td rowspan="3" style="width: 3%;border: 1px solid black;vertical-align: top;background:#bcd6ee" class="text-center">4</td>
                    <td colspan="3" class="td" style="border: 1px solid black;">EVALUASI KINERJA</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">CAPAIAN KINERJA ORGANISASI</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black; text-transform:uppercase;">{{ $dosen->skp->capaian_kinerja_organisasi }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;">PREDIKAT KINERJA PEGAWAI</td>
                    <td style="width: 3%; border:1px black solid;" class="text-center">:</td>
                    <td style="border: 1px solid black;">BAIK</td>
                </tr>

                <tr style="background:#bcd6ee">
                    <td rowspan="2" style="width: 3%;border: 1px solid black;vertical-align: top;background:#bcd6ee" class="text-center">3</td>
                    <td colspan="3" class="td" style="border: 1px solid black;">EVALUASI KINERJA</td>
                </tr>
                <tr>
                    <td colspan="3" class="td" style="border: 1px solid black; text-transform:uppercase; color:white">a</td>
                </tr>
                <tr style="border-left: 1px solid black;border-right: 1px solid black;">
                    <td colspan="2" class="text-center">
                        Bengkulu, {{ Carbon\Carbon::parse($dosen->skp->ttd_pejabat)->isoFormat('D MMMM Y') }}
                    </td>

                    <td colspan="2" class="text-center">
                        Bengkulu, {{ Carbon\Carbon::parse($dosen->skp->ttd_pejabat_penilai)->isoFormat('D MMMM Y') }}
                    </td>
                </tr>

                <tr style="border-left: 1px solid black;border-right: 1px solid black;">
                    <td colspan="2" class="text-center">
                        Pegawai Yang Dinilai
                    </td>

                    <td colspan="2" class="text-center">
                        Pejabat Penilai Kinerja
                    </td>
                </tr>

                <tr style="border-left: 1px solid black;border-right: 1px solid black;">
                    <td colspan="2" class="text-center" style="padding-top:20px">
                    </td>

                    <td colspan="2" class="text-center">
                    </td>
                </tr>
                
                <tr style="border-left: 1px solid black;border-right: 1px solid black;">
                    <td colspan="2" class="text-center">
                        {{ $dosen->gelar_depan.' '.$dosen->nama_dosen.', '.$dosen->gelar_belakang }}
                    </td>

                    <td colspan="2" class="text-center">
                        {{ $dosen->skp->penilai->gelar_depan.' '.$dosen->skp->penilai->nama_dosen.', '.$dosen->skp->penilai->gelar_belakang }}
                    </td>
                </tr>
                <tr style="border-left: 1px solid black;border-right: 1px solid black;">
                    <td colspan="2" class="text-center">
                        NIP: {{ $dosen->id }}
                    </td>
                    <td colspan="2" class="text-center">
                        NIP: {{ $dosen->skp->penilai->id }}
                    </td>
                </tr>
                <tr style="border-left: 1px solid black;border-right: 1px solid black;">
                    <td colspan="4" class="text-center">
                        Bengkulu, {{ Carbon\Carbon::parse($dosen->skp->ttd_pejabat)->isoFormat('D MMMM Y') }}
                    </td>

                <tr style="border-left: 1px solid black;border-right: 1px solid black;">
                    <td colspan="4" class="text-center">
                        Atasan Pejabat Penilai Kinerja,
                    </td>
                </tr>

                <tr style="border-left: 1px solid black;border-right: 1px solid black;">
                    <td colspan="2" class="text-center" style="padding-top:20px">
                    </td>

                    <td colspan="2" class="text-center">
                    </td>
                </tr>
                
                <tr style="border-left: 1px solid black;border-right: 1px solid black;">
                    <td colspan="4" class="text-center">
                        {{ $dosen->skp->atasanPenilai->gelar_depan.' '.$dosen->skp->atasanPenilai->nama_dosen.', '.$dosen->skp->atasanPenilai->gelar_belakang }}
                    </td>
                </tr>
                <tr style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;">
                    <td colspan="4" class="text-center">
                        NIP: {{ $dosen->skp->atasanPenilai->id }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
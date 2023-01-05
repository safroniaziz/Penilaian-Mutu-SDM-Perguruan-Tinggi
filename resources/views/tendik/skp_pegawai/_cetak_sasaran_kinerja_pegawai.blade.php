<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Lampiran Sasaran Kinerja Pegawai</title>
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
                    <td class="td" style="text-align: center">
                    <b>LAMPIRAN SASARAN KINERJA PEGAWAI</b></td>
                </tr>
            </table>
         
            <table width=100% style="margin-bottom:5px;" class="tb">
                <tr style="background:#bcd6ee">
                    <td colspan="2" style="border: 1px solid black;">
                        <b>DUKUNGAN SUMBER DAYA</b>
                    </td>
                </tr>
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black; width:3%" class="text-center">1</td>
                    <td style="border: 1px solid black;">Dukungan sarana administrasi yang memadai (printer, tinta, kertas, post it…)</td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">2</td>
                    <td style="border: 1px solid black;">Dukungan sarana prasarana IT yang memadai	</td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">3</td>
                    <td style="border: 1px solid black;">Dukungan pimpinan dalam pengambilan kebijakan internal	</td>
                </tr>
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black; color:white" class="text-center">2</td>
                    <td style="border: 1px solid black;"></td>
                </tr>

                <tr style="background:#bcd6ee">
                    <td colspan="2" style="border: 1px solid black;">
                        <b>SKEMA PERTANGGUNGJAWABAN</b>
                    </td>
                </tr>
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black; width:3%" class="text-center">1</td>
                    <td style="border: 1px solid black;">melaksanakan Kegiatan Sesuai surat tugas dan Instruksi pimpinan	
                    </td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">2</td>
                    <td style="border: 1px solid black;"></td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">3</td>
                    <td style="border: 1px solid black;"></td>
                </tr>
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black; color:white" class="text-center">2</td>
                    <td style="border: 1px solid black;"></td>
                </tr>

                <tr style="background:#bcd6ee">
                    <td colspan="2" style="border: 1px solid black;">
                        <b>KONSEKUENSI</b>
                    </td>
                </tr>
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black; width:3%" class="text-center">1</td>
                    <td style="border: 1px solid black;">untuk diikut sertakan diklat kompetensi	
                    </td>
                </tr>

                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;" class="text-center">2</td>
                    <td style="border: 1px solid black;"></td>
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
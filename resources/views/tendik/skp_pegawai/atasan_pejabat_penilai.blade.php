<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user-o"></i>&nbsp;Data Atasan Pejabat Penilai </h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <tr>
                            <th style="width: 15%">Nama Atasan Pejabat Penilai</th>
                            <th>:</th>
                            <td>
                                @if (strlen(Auth::guard('tendik')->user()->skp->atasan_pejabat_penilai_id) > 5)
                                    {{ Auth::guard('tendik')->user()->skp->atasanPenilaiDosen->gelar_depan.' '.Auth::guard('tendik')->user()->skp->atasanPenilaiDosen->nama_dosen.', '.Auth::guard('tendik')->user()->skp->atasanPenilaiDosen->gelar_belakang  }}
                                @else
                                    {{ Auth::guard('tendik')->user()->skp->atasanPenilai->nama_tendik }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 15%">NIP</th>
                            <th>:</th>
                            <td>
                                @if (strlen(Auth::guard('tendik')->user()->skp->atasan_pejabat_penilai_id) > 5)
                                    {{ Auth::guard('tendik')->user()->skp->atasanPenilaiDosen->id }}
                                @else
                                    {{ Auth::guard('tendik')->user()->skp->atasanPenilai->nip }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Pangkat/Golongan</th>
                            <th>:</th>
                            <td>
                                @if (strlen(Auth::guard('tendik')->user()->skp->atasan_pejabat_penilai_id) > 5)
                                    {{ Auth::guard('tendik')->user()->skp->atasanPenilaiDosen->pangkat != "" ? Auth::guard('tendik')->user()->skp->atasanPenilaiDosen->pangkat : '-'.'/'.Auth::guard('tendik')->user()->skp->atasanPenilaiDosen->golongan }}
                                @else
                                    {{ Auth::guard('tendik')->user()->skp->atasanPenilai->pangkat != "" ? Auth::guard('tendik')->user()->skp->atasanPenilai->pangkat : '-'.'/'.Auth::guard('tendik')->user()->skp->atasanPenilai->golongan }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Jabatan</th>
                            <th>:</th>
                            <td>
                                @if (strlen(Auth::guard('tendik')->user()->skp->atasan_pejabat_penilai_id) > 5)
                                    {{ Auth::guard('tendik')->user()->skp->atasanPenilaiDosen->jabatan_akademik }}
                                @else
                                    {{ Auth::guard('tendik')->user()->skp->atasanPenilai->jabatan }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Unit Kerja</th>
                            <th>:</th>
                            <td>
                                @if (strlen(Auth::guard('tendik')->user()->skp->atasan_pejabat_penilai_id) > 5)
                                    {{ Auth::guard('tendik')->user()->skp->atasanPenilaiDosen->prodi->unit->nama_unit }}
                                @else
                                    {{ Auth::guard('tendik')->user()->skp->atasanPenilai->unit->nama_unit }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
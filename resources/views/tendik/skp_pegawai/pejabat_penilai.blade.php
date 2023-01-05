<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user-o"></i>&nbsp;Data Pejabat Penilai </h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <tr>
                            <th style="width: 15%">Nama Pejabat Penilai</th>
                            <th>:</th>
                            <td>
                                @if (strlen(Auth::guard('tendik')->user()->skp->pejabat_penilai_id) > 5)
                                    {{ Auth::guard('tendik')->user()->skp->penilaiDosen->gelar_depan.' '.Auth::guard('tendik')->user()->skp->penilaiDosen->nama_dosen.', '.Auth::guard('tendik')->user()->skp->penilaiDosen->gelar_belakang  }}
                                @else
                                    {{ Auth::guard('tendik')->user()->skp->penilai->nama_tendik }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 15%">NIP</th>
                            <th>:</th>
                            <td>
                                @if (strlen(Auth::guard('tendik')->user()->skp->pejabat_penilai_id) > 5)
                                    {{ Auth::guard('tendik')->user()->skp->penilaiDosen->id }}
                                @else
                                    {{ Auth::guard('tendik')->user()->skp->penilai->nip }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Pangkat/Golongan</th>
                            <th>:</th>
                            <td>
                                @if (strlen(Auth::guard('tendik')->user()->skp->pejabat_penilai_id) > 5)
                                    {{ Auth::guard('tendik')->user()->skp->penilaiDosen->pangkat != "" ? Auth::guard('tendik')->user()->skp->penilaiDosen->pangkat : '-'.'/'.Auth::guard('tendik')->user()->skp->penilaiDosen->golongan }}
                                @else
                                    {{ Auth::guard('tendik')->user()->skp->penilai->pangkat != "" ? Auth::guard('tendik')->user()->skp->penilai->pangkat : '-'.'/'.Auth::guard('tendik')->user()->skp->penilai->golongan }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Jabatan</th>
                            <th>:</th>
                            <td>
                                @if (strlen(Auth::guard('tendik')->user()->skp->pejabat_penilai_id) > 5)
                                    {{ Auth::guard('tendik')->user()->skp->penilaiDosen->jabatan_akademik }}
                                @else
                                    {{ Auth::guard('tendik')->user()->skp->penilai->jabatan }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Unit Kerja</th>
                            <th>:</th>
                            <td>
                                @if (strlen(Auth::guard('tendik')->user()->skp->pejabat_penilai_id) > 5)
                                    {{ Auth::guard('tendik')->user()->skp->penilaiDosen->prodi->unit->nama_unit }}
                                @else
                                    {{ Auth::guard('tendik')->user()->skp->penilai->unit->nama_unit }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
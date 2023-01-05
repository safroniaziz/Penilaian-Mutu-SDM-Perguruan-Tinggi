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
                            <th style="width: 25%">Nama Atasan Pejabat Penilai</th>
                            <th>:</th>
                            <td>{{ $dosen->skp->atasanPenilai->gelar_depan.' '.$dosen->skp->atasanPenilai->nama_dosen.','.$dosen->skp->atasanPenilai->gelar_belakang }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%">NIP</th>
                            <th>:</th>
                            <td>{{ $dosen->skp->atasanPenilai->id }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%">Pangkat/Golongan</th>
                            <th>:</th>
                            <td>{{ $dosen->skp->atasanPenilai->pangkat != "" ? $dosen->skp->atasanPenilai->pangkat : '-'.'/'.$dosen->skp->atasanPenilai->golongan }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%">Jabatan</th>
                            <th>:</th>
                            <td>{{ $dosen->skp->atasanPenilai->jabatan_akademik }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%">Unit Kerja</th>
                            <th>:</th>
                            <td>{{ $dosen->skp->atasanPenilai->prodi->unit->nama_unit }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
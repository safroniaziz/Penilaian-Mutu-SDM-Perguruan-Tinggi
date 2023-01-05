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
                            <td>{{ $dosen->skp->penilai->gelar_depan.' '.$dosen->skp->penilai->nama_dosen.','.$dosen->skp->penilai->gelar_belakang }}</td>
                        </tr>
                        <tr>
                            <th style="width: 15%">NIP</th>
                            <th>:</th>
                            <td>{{ $dosen->skp->penilai->id }}</td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Pangkat/Golongan</th>
                            <th>:</th>
                            <td>{{ $dosen->skp->penilai->pangkat != "" ? $dosen->skp->penilai->pangkat : '-'.'/'.$dosen->skp->penilai->golongan }}</td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Jabatan</th>
                            <th>:</th>
                            <td>{{ $dosen->skp->penilai->jabatan_akademik }}</td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Unit Kerja</th>
                            <th>:</th>
                            <td>{{ $dosen->skp->penilai->prodi->unit->nama_unit }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
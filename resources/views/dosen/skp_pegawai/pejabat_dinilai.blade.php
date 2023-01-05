<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user"></i>&nbsp;Data Pejabat Yang Dinilai </h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <tr>
                            <th style="width: 15%">Nama Pejabat</th>
                            <th>:</th>
                            <td>{{ $dosen->gelar_depan.' '.$dosen->nama_dosen.','.$dosen->gelar_belakang }}</td>
                        </tr>
                        <tr>
                            <th style="width: 15%">NIP</th>
                            <th>:</th>
                            <td>{{ $dosen->id }}</td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Pangkat/Golongan</th>
                            <th>:</th>
                            <td>{{ $dosen->pangkat != "" ? $dosen->pangkat : '-'.'/'.$dosen->golongan }}</td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Jabatan</th>
                            <th>:</th>
                            <td>{{ $dosen->jabatan_akademik }}</td>
                        </tr>
                        <tr>
                            <th style="width: 15%">Unit Kerja</th>
                            <th>:</th>
                            <td>{{ $dosen->prodi->unit->nama_unit }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
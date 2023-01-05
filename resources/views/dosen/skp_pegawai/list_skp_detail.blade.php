<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-info-circle"></i>&nbsp;Detail SKP Dosen  </h3>
            <div class="pull-right">
                
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('dosen.skp.detail',[$dosen->skp->id]) }}" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i>&nbsp; Tambah Data Detail SKP</a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-flat btn-sm">Cetak Luaran SKP</button>
                        <button type="button" class="btn btn-success btn-flat btn-sm dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('dosen.skp.cetak_skp_pegawai') }}" target="_blank">Cetak SKP Pegawai</a></li>
                            <li><a href="{{ route('dosen.skp.cetak_sasaran_kinerja_pegawai') }}" target="_blank">Cetak Lampiran Sasaran Kinerja Pegawai</a></li>
                            <li><a href="{{ route('dosen.skp.evaluasi_pegawai') }}" target="_blank">Cetak Evaluasi Pegawai</a></li>
                            <li><a href="{{ route('dosen.skp.cetak_nilai_kinerja') }}" target="_blank">Cetak Status Nilai Kinerja</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-hover" id="detail" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>IKK Pimpinan</th>
                                <th>Keterangan IKK Pimpinan</th>
                                <th>Isi SKP</th>
                                <th>Target SKP</th>
                                <th>Realisasi Bukti Dukung</th>
                                <th>Umpan Balik Berkelanjutan</th>
                                <th>Hasil Kerja</th>
                                <th>Angka</th>
                                <th>Ubah Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosen->skp->skpDetails()->get() as $index=> $detail)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $detail->ikkPimpinan->judul_ikk }}</td>
                                    <td>{{ $detail->ikkPimpinan->keterangan_ikk }}</td>
                                    <td>{{ $detail->isi_ikk }}</td>
                                    <td>{{ $detail->target_ikk }}</td>
                                    <td>{{ $detail->realisasi_bukti_dukung }}</td>
                                    <td>{{ $detail->umpan_balik_berkelanjutan }}</td>
                                    <td>
                                        @if ($detail->angka == "1")
                                            Dibawah Ekspektasi
                                        @elseif($detail->angka == "2")
                                            Sesuai Ekspektasi
                                        @else
                                            Diatas Ekspektasi
                                        @endif
                                    </td>
                                    <td>{{ $detail->angka }}</td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <a href="{{ route('dosen.skp.skp_detail_edit',[$detail->id]) }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-edit"></i>&nbsp; Ubah</a>
                                                </td>
                                                <td>
                                                    <a onclick="hapusSkpDetail({{ $detail->id }})" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i>&nbsp; Hapus</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <div class="modal fade" id="modalhapusskpdetail">
                            <form action="{{ route('dosen.skp.detail_delete') }}" method="POST">
                                {{ csrf_field() }} {{ method_field("DELETE") }}
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Konfirmasi Hapus Data SKP Detail</h4>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus data SKP Detail?
                                            <input type="hidden" name="skp_detail_id" id="skp_detail_id">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm btn-flat " data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batalkan</button>
                                            <button type="submit" id="btnSubmit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp;Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#detail').DataTable({
                responsive : true,
            });
        } );

        function hapusSkpDetail(id){
            $('#modalhapusskpdetail').modal('show');
            $('#skp_detail_id').val(id);
        }
    </script>
@endpush
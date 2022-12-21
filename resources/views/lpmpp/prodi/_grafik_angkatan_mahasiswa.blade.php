<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pie-chart"></i>&nbsp;Grafik Jumlah Mahasiswa Per Angkatan</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_angkatan_mahasiswa')
                        var data = [
                            @foreach ($grafikAngkatan as $grafik)
                                {
                                    country: "{{ $grafik->angkatan }}",
                                    value: {{ $grafik->jumlah_mahasiswa }}
                                },
                            @endforeach
                        ];
                    @endsection
                    <div id="chartdivangkatanmahasiswa"></div>
                </div>
            </div>
        </div>
    </div>
</div>
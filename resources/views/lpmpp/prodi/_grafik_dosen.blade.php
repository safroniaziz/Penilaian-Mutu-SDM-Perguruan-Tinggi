<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pie-chart"></i>&nbsp;Grafik Jumlah Dosen Per Fakultas</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart2')
                        series.data.setAll([
                            @foreach ($grafikDosen as $dosen)
                                { value: {{ $dosen->prodis()->sum('jumlah_dosen') }}, category: "{{ $dosen->nama_singkatan }}" },
                            @endforeach
                        ]);
                    @endsection
                    <div id="chartdiv2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
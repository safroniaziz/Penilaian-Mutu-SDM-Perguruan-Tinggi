<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pie-chart"></i>&nbsp;Grafik Jumlah Dosen Per Fakultas</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_jumlah_dosen')
                        series.data.setAll([
                            @foreach ($grafikJumlahDosen as $grafik)
                                { value:  {{ $grafik->prodis()->sum('jumlah_dosen') }}, category: "{{ $grafik->nama_singkatan }}" },
                            @endforeach
                        ]);
                    @endsection
                    <div id="chartdivjumlahdosen"></div>
                </div>
            </div>
        </div>
    </div>
</div>
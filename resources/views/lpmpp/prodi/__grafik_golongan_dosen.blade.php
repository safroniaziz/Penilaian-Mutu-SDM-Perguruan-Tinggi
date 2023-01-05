<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pie-chart"></i>&nbsp;Grafik Jumlah Dosen Per Golongan</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_golongan_dosen')
                        series.data.setAll([
                            @foreach ($grafikGolongan as $grafik)
                                { value: {{ $grafik->jumlah_dosen }}, category: "{{ $grafik->golongan }}" },
                            @endforeach
                        ]);
                    @endsection
                    <div id="chartdivgolongandosen"></div>
                </div>
            </div>
        </div>
    </div>
</div>
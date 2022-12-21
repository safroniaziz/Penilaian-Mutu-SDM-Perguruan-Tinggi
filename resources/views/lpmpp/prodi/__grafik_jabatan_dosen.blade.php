<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pie-chart"></i>&nbsp;Grafik Jumlah Dosen Per Jabatan Akademik</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_jabatan_dosen')
                        series.data.setAll([
                            @foreach ($grafikJabatan as $grafik)
                                { value: {{ $grafik->jumlah_dosen }}, category: "{{ $grafik->jabatan_akademik }}" },
                            @endforeach
                        ]);
                    @endsection
                    <div id="chartdivjabatandosen"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="">
                <b style="text-transform: capitalize">Grafik Data Dosen Per Jabatan Akademik</b>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_per_jabatan_dosen')
                        series.data.setAll([
                            @foreach ($grafikPerJabatan as $grafik)
                                { value:  {{ $grafik->jumlah_dosen }}, category: "{{ $grafik->jabatan_akademik }}" },
                            @endforeach
                        ]);
                    @endsection
                    <div id="chartdivperjabatandosen"></div>
                </div>
            </div>
        </div>
    </div>
</div>
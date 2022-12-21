<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="">
                <b style="text-transform: capitalize">Grafik Data Tendik Per Kelas Jabatan</b>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_tendik_per_kelas')
                        series.data.setAll([
                            @foreach ($grafikTendikPerKelas as $grafik)
                                { value:  {{ $grafik->jumlah_tendik }}, category: "Kelas {{ $grafik->kelas_jabatan }}" },
                            @endforeach
                        ]);
                    @endsection
                    <div id="chartdivtendikperkelas"></div>
                </div>
            </div>
        </div>
    </div>
</div>
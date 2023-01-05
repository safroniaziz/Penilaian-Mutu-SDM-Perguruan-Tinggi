<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="">
                <b style="text-transform: capitalize">Grafik Data Dosen Per Fakultas</b>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_per_fakultas')
                        series.data.setAll([
                            @foreach ($grafikPerFakultas as $grafik)
                                { value:  {{ $grafik->prodis()->sum('jumlah_dosen') }}, category: "{{ $grafik->nama_singkatan }}" },
                            @endforeach
                        ]);
                    @endsection
                    <div id="chartdivperfakultas"></div>
                </div>
            </div>
        </div>
    </div>
</div>
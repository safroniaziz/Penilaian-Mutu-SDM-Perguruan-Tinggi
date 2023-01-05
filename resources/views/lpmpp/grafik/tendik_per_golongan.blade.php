<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="">
                <b style="text-transform: capitalize">Grafik Data Tendik Per Golongan</b>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_tendik_per_golongan')
                        series.data.setAll([
                            @foreach ($grafikTendikPerGolongan as $grafik)
                                { value:  {{ $grafik->jumlah_tendik }}, category: "{{ $grafik->golongan }}" },
                            @endforeach
                        ]);
                    @endsection
                    <div id="chartdivtendikpergolongan"></div>
                </div>
            </div>
        </div>
    </div>
</div>
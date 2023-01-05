<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="">
                <b style="text-transform: capitalize">Grafik Data Tendik Per Unit</b>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_per_unit')
                        var data = [
                            @foreach ($grafikPerUnit as $grafik)
                                {
                                    country: "{{ $grafik->unit->nama_singkatan ?? 'TIdak diketahui' }}",
                                    value: {{ $grafik->jumlah_tendik }}
                                },
                            @endforeach
                        ];
                    @endsection
                    <div id="chartdivperunit"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="">
                <b style="text-transform: capitalize">Grafik Data Tendik Per Pangkat</b>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_tendik_per_pangkat')
                        var data = [
                            @foreach ($grafikTendikPerPangkat as $grafik)
                                {
                                    country: "{{ $grafik->pangkat ?? 'TIdak diketahui' }}",
                                    value: {{ $grafik->jumlah_tendik }}
                                },
                            @endforeach
                        ];
                    @endsection
                    <div id="chartdivtendikperpangkat"></div>
                </div>
            </div>
        </div>
    </div>
</div>
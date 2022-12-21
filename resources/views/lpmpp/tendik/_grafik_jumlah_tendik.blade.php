<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pie-chart"></i>&nbsp;Grafik Jumlah Tendik Per Unit</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_jumlah_tendik')
                    var data = [
                        @foreach ($grafikJumlahTendik as $grafik)
                            {
                                country: "{{ $grafik->nama_singkatan }}",
                                value: {{ $grafik->jumlah_tendik }}
                            },
                        @endforeach
                    ];
                    @endsection
                    <div id="chartdivjumlahtendik"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="">
                <b style="text-transform: capitalize">Grafik Data Dosen Per Jenis Kelamin</b>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_per_jk')
                        series.data.setAll([
                            @foreach ($grafikPerJk as $grafik)
                                { value: {{ $grafik->jumlah_dosen }}, @if ($grafik->jenis_kelamin == "L")
                                    category: "Laki-Laki"
                                @elseif ($grafik->jenis_kelamin == "P")
                                    category: "Perempuan"
                                @else
                                    category: "Tidak Terdata Di SIAKAD"
                                @endif },
                            @endforeach
                        ]);
                    @endsection
                    <div id="chartdivperjk"></div>
                </div>
            </div>
        </div>
    </div>
</div>
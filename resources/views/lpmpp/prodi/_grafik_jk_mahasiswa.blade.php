<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pie-chart"></i>&nbsp;Grafik Jumlah Mahasiswa Per Jenis Kelamin</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @section('pie_chart_jk_mahasiswa')
                        series.data.setAll([
                            @foreach ($grafikJk as $grafik)
                                { value: {{ $grafik->jumlah_mahasiswa }}, @if ($grafik->jenis_kelamin == "L")
                                    category: "Laki-Laki"
                                @elseif ($grafik->jenis_kelamin == "P")
                                    category: "Perempuan"
                                @else
                                    category: "Tidak Terdata Di SIAKAD"
                                @endif },
                            @endforeach
                        ]);
                    @endsection
                    <div id="chartdivjkmahasiswa"></div>
                </div>
            </div>
        </div>
    </div>
</div>
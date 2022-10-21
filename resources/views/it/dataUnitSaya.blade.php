@extends('it.mainIt')

@section('dataUnitSaya')
active
@endsection

@section('hal')
Data Unit Saya
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Tabel Request
        </div>
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr>
                        <th>nama_unit</th>
                        <th>brand_unit</th>
                        <th>tipe_unit</th>
                        <th>tahun_unit</th>
                        <th>jenis_unit</th>
                        <th>tgl_regis_unit</th>
                        <th>status_unit</th>
                        <th>ket_unit</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataunit as $item)
                    <tr>
                        <td>{{ $item->nama_unit }}</td>
                        <td>{{ $item->brand_unit }}</td>
                        <td>{{ $item->tipe_unit }}</td>
                        <td>{{ $item->tahun_unit }}</td>
                        <td>{{ $item->jenis_unit }}</td>
                        <td>{{ $item->tgl_regis_unit }}</td>
                        <td>{{ $item->status_unit }}</td>
                        <td>{{ $item->ket_unit }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection
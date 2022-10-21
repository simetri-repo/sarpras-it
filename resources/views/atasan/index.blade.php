@extends('atasan.mainAtasan')

@section('home')
active
@endsection

@section('hal')

@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Unit Ready
        </div>
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr>
                        <th>Nama Unit</th>
                        <th>Brand</th>
                        <th>Tipe</th>
                        <th>Tahun Unit</th>
                        <th>Jenis Unit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataunit as $item)
                    <tr>
                        <td>{{ $item->nama_unit }}</td>
                        <td>{{ $item->brand_unit }}</td>
                        <td>{{ $item->tipe_unit }}</td>
                        <td>{{ $item->tahun_unit }}</td>
                        <td>{{ $item->nama_jnsBarang }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection
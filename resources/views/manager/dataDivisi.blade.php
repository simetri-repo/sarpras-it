@extends('manager.mainManager')

@section('showAnggotaDivisi')
active
@endsection

@section('hal')
Data Anggota Divisi
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Tabel Anggota Divisi
        </div>
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama_user }}</td>
                        <td>@if ($item->role == '5')
                            Atasan
                            @elseif ($item->role == '7')
                            Manager
                            @else
                            Anggota Divisi
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection
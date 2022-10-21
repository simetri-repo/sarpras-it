@extends('atasan.mainAtasan')

@section('dataPengajuanDivisi')
active
@endsection

@section('hal')
Pengajuan Saya
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Tabel Pengajuan Saya
        </div>
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Tgl Pengajuan</th>
                        <th>Status</th>
                        <th>No Token</th>
                        <th>updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dt_pengajuan as $item)
                    <tr>
                        <td><b>{{ $item->nama_unit }} {{ $item->brand_unit }} {{ $item->tipe_unit }}</b></td>
                        <td>{{ \Carbon\Carbon::parse($item->tgl_pengajuan)->isoFormat('DD-MM-YYYY') }}</td>
                        <td>@if ($item->status_pengajuan == '11')
                            <span class="badge bg-1"> Menunggu Acc Atasan </span>
                            @elseif ($item->status_pengajuan == '21')
                            <span class="badge bg-2">Acc Atasan</span>
                            @elseif ($item->status_pengajuan == '31')
                            <span class="badge bg-3">Acc IT</span>
                            @elseif ($item->status_pengajuan == '81')
                            <span class="badge bg-4">Acc Admin IT</span>
                            @elseif ($item->status_pengajuan == '41')
                            <span class="badge bg-5">Dalam Pengerjaan</span>
                            @elseif ($item->status_pengajuan == '42')
                            <span class="badge bg-6">Progress Pengerjaan</span>
                            @elseif ($item->status_pengajuan == '29')
                            <span class="badge bg-danger">Ditolak Oleh Atasan</span>
                            @elseif ($item->status_pengajuan == '39')
                            <span class="badge bg-danger">Ditolak Oleh IT</span>
                            @elseif ($item->status_pengajuan == '89')
                            <span class="badge bg-danger">Ditolak Admin IT</span>
                            @elseif ($item->status_pengajuan == '91')
                            <span class="badge bg-7">Dalam Penggunaan</span>
                            @elseif ($item->status_pengajuan == '92')
                            <span class="badge bg-success">SELESAI - Sudah Dikembalikan</span>
                            @elseif ($item->status_pengajuan == '93')
                            <span class="badge bg-8">Request Pengembalian</span>
                            @elseif ($item->status_pengajuan == '94')
                            <span class="badge bg-9">Progress Pengembalian</span>
                            @elseif ($item->status_pengajuan == '71')
                            <span class="badge bg-3">Menunggu Acc VP</span>
                            @endif
                        </td>
                        <td>{{ $item->no_token }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->update_at)->isoFormat('DD-MM-YYYY') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection
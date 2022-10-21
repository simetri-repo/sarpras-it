@extends('it.mainIt')

@section('dataAllUnit')
active
@endsection

@section('hal')
Data Peminjaman
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class='table table-striped' id="table1">
                <thead>
                    <tr>
                        <th>Id Unit</th>
                        <th>Nama</th>
                        <th>Brand</th>
                        <th>Tipe</th>
                        <th>Status Unit</th>
                        <th>Status ACC</th>
                        <th>Peminjam</th>
                        <th>Tgl Pinjam</th>
                        <th>ket_kembali</th>
                        <th>PIC Unit</th>
                        <th>Update at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataunit as $item)
                    <tr>
                        <td>{{ $item->id_unit }}</td>
                        <td>{{ $item->nama_unit }}</td>
                        <td>{{ $item->brand_unit }}</td>
                        <td style="text-align: center;"">{{ $item->tipe_unit }}</td>
                            <td style=" text-align: center;"">
                            @if ($item->status_unit == '1')
                            <span class=" badge bg-primary">
                                {{ $item->nama_statUnit }}
                            </span>
                            @elseif ($item->status_unit == '2')
                            <span class="badge bg-danger">
                                {{ $item->nama_statUnit }}
                            </span>
                            @elseif ($item->status_unit == '3')
                            <span class="badge bg-warning">
                                {{ $item->nama_statUnit }}
                            </span>
                            @elseif ($item->status_unit == '4')
                            <span class="badge bg-success">
                                {{ $item->nama_statUnit }}
                            </span>
                            @elseif ($item->status_unit == '5')
                            <span class="badge bg-light">
                                {{ $item->nama_statUnit }}
                            </span>

                            @endif
                        </td>
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
                        <td>{{ $item->nik }} - {{ $item->nama_user }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tgl_pengajuan)->isoFormat('DD-MM-YYYY') }}</td>
                        <td>{{ $item->ket_kembali }}</td>
                        <td>{{ $item->pic_unit }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->update_at)->isoFormat('DD-MM-YYYY') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>

@endsection
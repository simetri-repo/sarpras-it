@extends('admin_it.mainAdminIt')

@section('allDataPengajuan')
active
@endsection

@section('hal')
Data Pengajuan
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            All Data Pengajuan
        </div>
        <div class="card-body">
            <table class='table table-striped' id="dt_table">
                <thead>
                    <tr>
                        <th>NIK Request</th>
                        <th>Divisi</th>
                        <th>Unit</th>
                        <th>Tgl Pengajuan</th>
                        <th>Status</th>
                        <th>ket pengajuan</th>
                        <th>ket apprv</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dt_pengajuan as $item)
                    <tr>
                        <td>{{ $item->nik }} - {{ $item->nama_user }}</td>
                        <td>{{ $item->nama_divisi }}</td>
                        <td><b>{{ $item->nama_unit }} {{ $item->brand_unit }} {{ $item->tipe_unit }}</b></td>
                        <td>{{ $item->tgl_pengajuan }}</td>
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
                        <td>{{ $item->ket_pengajuan }}</td>
                        <td>{{ $item->ket_approval }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection

@section('style')
{{-- datatables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" />
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 2px !important;
        margin-top: 5px;
    }
</style>
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
{{-- datatables --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
            $('#dt_table').DataTable( {
            "order": [[5,"desc"]],
            dom: 'Bfrtip',
            buttons: [
            'excel', 'print'
            ]
            } );
            } );
</script>
@endsection
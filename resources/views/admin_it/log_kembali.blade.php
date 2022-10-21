@extends('admin_it.mainAdminIt')

@section('Admlog_kembali')
active
@endsection

@section('hal')
Data Log Pengembalian
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Log Pengembalian
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class='table table-striped display' id="dt_table">
                    <thead>
                        <tr>
                            <th>Nik User</th>
                            <th>Unit</th>
                            <th>Tgl_Pengajuan</th>
                            <th>Ket</th>
                            <th>Status</th>
                            <th>Update_At</th>
                            <th>Update_By</th>

                            <th>Divisi</th>
                            <th>Pic_Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dt_pengajuan as $item)
                        <tr>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nama_unit }}</td>
                            <td>{{ $item->tgl_pengajuan }}</td>
                            <td>{{ $item->ket_kembali }}</td>
                            <td>@if ($item->status_pengajuan == '11')
                                <b>Menunggu Acc Atasan</b>
                                @elseif ($item->status_pengajuan == '21')
                                <b>Acc Atasan</b>
                                @elseif ($item->status_pengajuan == '31')
                                <b>Acc IT</b>
                                @elseif ($item->status_pengajuan == '81')
                                <b>Acc Admin IT</b>

                                @elseif ($item->status_pengajuan == '41')
                                <b>Dalam Pengerjaan</b>
                                @elseif ($item->status_pengajuan == '42')
                                <b>Progress Pengerjaan</b>

                                @elseif ($item->status_pengajuan == '29')
                                <b>Ditolak Oleh Atasan</b>
                                @elseif ($item->status_pengajuan == '39')
                                <b>Ditolak Oleh IT</b>
                                @elseif ($item->status_pengajuan == '89')
                                <b>Ditolak Admin IT</b>

                                @elseif ($item->status_pengajuan == '91')
                                <b>Dalam Penggunaan</b>
                                @elseif ($item->status_pengajuan == '92')
                                <b>SELESAI - Sudah Dikembalikan</b>
                                @elseif ($item->status_pengajuan == '93')
                                <b>Request Pengembalian</b>
                                @elseif ($item->status_pengajuan == '94')
                                <b>Progress Pengembalian</b>
                                @endif
                            </td>
                            <td>{{ $item->update_at }}</td>
                            <td>{{ $item->update_by }}</td>

                            <td>{{ $item->nama_divisi }}</td>
                            <td>{{ $item->pic_unit }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
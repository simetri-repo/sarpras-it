@extends('admin_it.mainAdminIt')

@section('dataUnitBarang')
active
@endsection

@section('hal')
Data Log Pengajuan
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Log Pengajuan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class='table table-striped display' id="dt_table">
                    <thead>
                        <tr> 
                            <th>Id Unit</th>
                            <th>Nama</th>
                            <th>Brand</th>
                            <th>Tipe</th>
                            <th>Jenis Unit</th>
                            <th>Waktu Regis</th>
                            <th>Status Unit</th>
                            <th>ket</th>
                            <th>PIC Update</th>
                            <th>PIC PJ</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataunit as $item)
                        <tr>
                            <td>{{ $item->id_unit }}</td>
                            <td>{{ $item->nama_unit }}</td>
                            <td>{{ $item->brand_unit }}</td>
                            <td style="text-align: center;"">{{ $item->tipe_unit }}</td>
                                    <td><b>{{ $item->nama_jnsBarang }}</b></td>
                                    <td>{{ $item->tgl_regis_unit }}</td>
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
                                <span class="badge bg-info">
                                    {{ $item->nama_statUnit }}
                                </span>

                                @endif
                            </td>
                            <td>{{ $item->ket_unit }}</td>
                            <td><b>{{ $item->nama_user }}</b></td>
                            <td><b>{{ $item->pic_unit }}</b></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('editDataUnit/'.$item->id_unit) }}" class="btn btn-warning icon"><i
                                            class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger icon" data-bs-toggle="modal"
                                        data-bs-target="#modelId{{ $item->id_unit }}"><i
                                            class="fa fa-trash"></i></button>


                                    <!-- Modal -->
                                    <div class="modal fade" id="modelId{{ $item->id_unit }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmation delete?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin akan menghapus data "{{ $item->nama_unit }} {{
                                                    $item->brand_unit }} {{ $item->tipe_unit }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ url('deleteUnit/'.$item->id_unit) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
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
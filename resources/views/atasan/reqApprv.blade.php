@extends('atasan.mainAtasan')

@section('dataWaitAccAtasan')
active
@endsection

@section('hal')
Request Approval
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
                        <th>NIK Request</th>
                        <th>Unit</th>
                        <th>Tgl Pengajuan</th>
                        <th>Status</th>
                        <th>No Token</th>
                        <th>Ket*</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dt_pengajuan as $item)
                    <tr>
                        <td>{{ $item->nik }} - {{ $item->nama_user }}</td>
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
                        <td>{{ $item->no_token }}</td>
                        <td>{{ $item->ket_pengajuan }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">

                                <button type="button" class="btn btn-success icon" data-bs-toggle="modal"
                                    data-bs-target="#accId{{ $item->no_token }}"><i class="fa fa-check"></i></button>
                                <!-- Modal -->
                                <div class="modal fade" id="accId{{ $item->no_token }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmation Acc?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form
                                                action="{{ url('hasilPengajuanAtasan/1/'.$item->no_token.'/'.$item->id_unit) }}"
                                                method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    {{-- <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="email-id-column">Catatan Approval : </label>
                                                            <textarea name="ketApproval" class="form-control" id=""
                                                                rows="3"></textarea>
                                                        </div>
                                                    </div> --}}
                                                    Acc pengajuan "{{ $item->nama_unit }} {{
                                                    $item->brand_unit }} {{ $item->tipe_unit }}" dari {{ $item->nik }} -
                                                    {{
                                                    $item->nama_user }}
                                                    ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button class="btn btn-success">Acc</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger icon" data-bs-toggle="modal"
                                    data-bs-target="#rejectId{{ $item->no_token }}"><i class="fa fa-times"></i></button>

                                <!-- Modal -->
                                <div class="modal fade" id="rejectId{{ $item->no_token }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmation Reject?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form
                                                action="{{ url('hasilPengajuanAtasan/9/'.$item->no_token.'/'.$item->id_unit) }}"
                                                method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="email-id-column">Catatan Reject : </label>
                                                            <textarea name="ketReject" class="form-control" id=""
                                                                rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    Apakah anda yakin akan tolak pengajuan "{{ $item->nama_unit }} {{
                                                    $item->brand_unit }} {{ $item->tipe_unit }}" dari {{ $item->nik }} -
                                                    {{
                                                    $item->nama_user }}
                                                    ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </div>
                                            </form>
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

</section>
@endsection
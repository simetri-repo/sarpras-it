@extends('admin.mainAdmin')

@section('datauser')
active
@endsection

@section('hal')
DataUserEdit
@endsection

@section('content')

<section class="section ">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4>USER : {{ $data->nik }}</h4>
            </div>

            <div class="card-body">
                <form class="form form-horizontal" method="POST" action="{{ url('edituser/'. $data->id_user) }}">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>NIK</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="first-name" class="form-control" name="nik" placeholder="NIK"
                                    value="{{ $data->nik }}">
                            </div>
                            <div class="col-md-4">
                                <label>Nama User</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="email-id" class="form-control" name="nama_user"
                                    placeholder="Nama User" value="{{ $data->nama_user }}">
                            </div>
                            <div class="col-md-4">
                                <label>Divisi</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" name="divisi" id="basicSelect">
                                    <option value="{{ $data->id_divisi }}" selected>{{ $data->nama_divisi }}</option>
                                    <option value="" disabled>------------------------------</option>
                                    @foreach ($divisi as $item)
                                    <option value="{{ $item->id_divisi }}">{{ $item->nama_divisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Role</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" name="role" id="basicSelect">
                                    @if ($data->role == 1)
                                    <option value="1" selected>Admin</option>
                                    <option value="3">Admin IT</option>
                                    <option value="4">IT</option>
                                    <option value="6">User Divisi</option>
                                    <option value="7">Manager</option>
                                    <option value="5">Atasan</option>
                                    @elseif ($data->role == 3)
                                    <option value="1">Admin</option>
                                    <option value="3" selected>Admin IT</option>
                                    <option value="4">IT</option>
                                    <option value="6">User Divisi</option>
                                    <option value="7">Manager</option>
                                    <option value="5">VP</option>
                                    @elseif ($data->role == 4)
                                    <option value="1">Admin</option>
                                    <option value="3">Admin IT</option>
                                    <option value="4" selected>IT</option>
                                    <option value="6">User Divisi</option>
                                    <option value="7">Manager</option>
                                    <option value="5">VP</option>
                                    @elseif ($data->role == 5)
                                    <option value="1">Admin</option>
                                    <option value="3">Admin IT</option>
                                    <option value="4">IT</option>
                                    <option value="5" selected>VP</option>
                                    <option value="6">User Divisi</option>
                                    <option value="7">Manager</option>
                                    @elseif ($data->role == 6)
                                    <option value="1">Admin</option>
                                    <option value="3">Admin IT</option>
                                    <option value="4">IT</option>
                                    <option value="6" selected>User Divisi</option>
                                    <option value="7">Manager</option>
                                    <option value="5">VP</option>
                                    @elseif ($data->role == 7)
                                    <option value="1">Admin</option>
                                    <option value="3">Admin IT</option>
                                    <option value="4">IT</option>
                                    <option value="6">User Divisi</option>
                                    <option value="7" selected>Manager</option>
                                    <option value="5">VP</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Status Akun</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" name="status_akun" id="basicSelect">
                                    @if ($data->status_akun == 1)
                                    <option value="1" selected>Aktif</option>
                                    <option value="9">Tidak Aktif</option>
                                    @elseif ($data->status_akun == 9)
                                    <option value="1">Aktif</option>
                                    <option value="9" selected>Tidak Aktif</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-sm-12 d-flex justify-content-end">

                                <div class="btn-group mb-3" role="group" aria-label="Basic example">

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDel"><i data-feather="trash"></i></button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#modalRkey"><i data-feather="key"></i></button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalSave"><i data-feather="save"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal save -->
                    <div class="modal fade" id="modalSave" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                        aria-hidden="true">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title white" id="myModalLabel140">Simpan Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah data sudah benar?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <a href="{{ url('showuser') }}" class=" btn btn-light">
            Back
        </a>
    </div>
</section>
{{-- modal confirmation --}}

<!-- Modal delete -->
<div class="modal fade" id="modalDel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="myModalLabel140">Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Anda yakin akan menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <a href="{{ url('deleteuser/'.$data->id_user) }}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal reset -->
<div class="modal fade" id="modalRkey" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title white" id="myModalLabel140">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Password akun akan di reset, apakah anda yakin?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <a href="{{ url('resetpass/' . $data->nik . '/' . $data->id_user) }}" class="btn btn-warning">Reset
                    Pass</a>
            </div>
        </div>
    </div>
</div>
@endsection
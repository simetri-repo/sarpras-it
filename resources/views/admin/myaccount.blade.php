@extends('admin.mainAdmin')

@section('')
active
@endsection

@section('hal')
My Account
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
                                    value="{{ $data->nik }}" readonly>
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
                                <input type="text" id="email-id" class="form-control" name="nama_user"
                                    placeholder="Nama User" value="{{ $data->nama_divisi }}" readonly>

                            </div>
                            <div class="col-sm-12 d-flex justify-content-end">
                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                    <a class="btn btn-warning" data-bs-toggle="modal" href="#exampleModalToggle"
                                        role="button">Ganti PAssword</a>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalSave">Simpan</button>
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
    </div>
</section>
{{-- modal confirmation --}}
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form form-vertical">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">Password Lama</label>
                                    <input type="password" id="password-vertical" class="form-control" name="passLama"
                                        placeholder="Password Lama">
                                </div>
                            </div>
                            <div class="divider">
                                <div class="divider-text">Verification</div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">Password Baru</label>
                                    <input type="password" id="inputPassword" class="form-control" name="passBaru"
                                        placeholder="Password Baru">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">re Password Baru</label>
                                    <input type="password" id="inputRePassword" class="form-control" name="repassBaru"
                                        placeholder="rePassword">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="smbt" disabled data-bs-target="#exampleModalToggle2"
                    data-bs-toggle="modal" data-bs-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan melakukan perubahan password?
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                    data-bs-dismiss="modal">Back</button>
                <button type="submit" class="btn btn-secondary"><i data-feather="save"></i></button>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection

@section('script')
<script>
    var psw = document.getElementById("inputPassword");
    var repsw = document.getElementById("inputRePassword");
 
        psw.onkeyup = function() {
        if(repsw.value == psw.value){
        repsw.classList.remove("is-invalid");
        repsw.classList.add("is-valid");
        // smbt.disabled = false;
        document.getElementById("smbt").disabled = false;
        } else {
        repsw.classList.remove("is-valid");
        repsw.classList.add("is-invalid");
        // smbt.disabled = true;
        document.getElementById("smbt").disabled = true;
        }
        }
        repsw.onkeyup = function() {
        if(repsw.value == psw.value){
        repsw.classList.remove("is-invalid");
        repsw.classList.add("is-valid");
        // smbt.disabled = false;
        document.getElementById("smbt").disabled = false;
        } else {
        repsw.classList.remove("is-valid");
        repsw.classList.add("is-invalid");
        // smbt.disabled = true;
        document.getElementById("smbt").disabled = true;
        }
        }
</script>
@endsection
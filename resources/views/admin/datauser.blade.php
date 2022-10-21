@extends('admin.mainAdmin')

@section('datauser')
active
@endsection

@section('hal')
DataUser
@endsection

@section('content')

<section class="section ">
    <div class="card ">
        <div class="card-header">
            {{-- <a href="#" class="btn icon icon-left btn-secondary"><i data-feather="plus"></i>
                Add New</a> --}}
            <!-- Button trigger modal -->
            <button type="button" class="btn icon icon-left btn-secondary" data-bs-toggle="modal"
                data-bs-target="#modelId">
                Add New
            </button>



        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class='table table-striped ' id="table1">
                    <thead>
                        <tr>

                            <th>Nik</th>
                            <th>Nama User</th>
                            <th>Divisi</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>
                                <b>{{$item->nik}}</b>
                            </td>
                            <td>{{$item->nama_user}}</td>
                            <td>{{$item->nama_divisi}}</td>
                            <td> <b>
                                    @if ($item->role == 1)
                                    Admin
                                    @elseif($item->role == 3)
                                    Admin IT
                                    @elseif($item->role == 4)
                                    IT
                                    @elseif($item->role == 6)
                                    User Divisi
                                    @elseif($item->role == 7)
                                    Manager
                                    @elseif($item->role == 5)
                                    VP
                                    @endif
                                </b>
                            </td>
                            <td>@if ($item->status_akun == 1)
                                <span class="badge bg-success">Aktif</span>
                                @else
                                <span class="badge bg-danger">Blocked</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('showuserid/'. $item->id_user) }}" class="btn btn-warning icon btn-sm">
                                    Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</section>
<!-- Modal -->
<div class="modal fade text-left" id="modelId" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title white" id="myModalLabel140">
                    Add Data User</h5>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal" method="POST" action="{{ url('saveuser') }}">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>NIK</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nik" class="form-control" name="nik" placeholder="NIK"
                                    onkeyup="validNik()">
                            </div>
                            <div class="col-md-4">
                                <label>Nama User</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nama_user" class="form-control" name="nama_user"
                                    placeholder="Nama User" onkeyup="val_username()">
                            </div>
                            <div class="col-md-4">
                                <label>Divisi</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" name="divisi" id="basicSelect">
                                    <option value="" selected disabled>-- Pilih --</option>
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
                                    <option value="" selected disabled>-- Pilih --</option>
                                    <option value="3">Admin IT</option>
                                    <option value="4">IT</option>
                                    <option value="6">User Divisi</option>
                                    <option value="7">Manager</option>
                                    <option value="5">VP</option>
                                </select>
                            </div>

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-light me-1 mb-1" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" id="sef" class="btn btn-secondary me-1 mb-1">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    function validNik() {
   var r_id = $('#nik').val();
   if (r_id) {
      // jantan
    $.ajax({
         type: "GET",
         url: "/v_nik?nik="+r_id,
         success: function (data) {
            if (data) {
                var element = document.getElementById("nik");
                element.classList.remove("is-valid");
                element.classList.add("is-invalid");
                document.getElementById("sef").disabled = true;
                // console.log('no');

                // $("#untBrg").append('<option value="' + res.id_unit + '">' + res.brand_unit +' '+ res.tipe_unit + '</option>');
                // var aa = count(res.id_user);
                //  console.log(xyz);

            } else {
                var element = document.getElementById("nik");
                element.classList.remove("is-invalid");
                element.classList.add("is-valid");
                document.getElementById("sef").disabled = false;
                // console.log('ok');
            }
            
         }
      });
    }
    }
    

        function val_username() {
   var r_id = $('#nama_user').val();
   if (r_id) {
      // jantan
    $.ajax({
         type: "GET",
         url: "/v_username?nama_user="+r_id,
         success: function (data) {
            if (data) {
                var element = document.getElementById("nama_user");
                element.classList.remove("is-valid");
                element.classList.add("is-invalid");
                document.getElementById("sef").disabled = true;
                // console.log('no');

                // $("#untBrg").append('<option value="' + res.id_unit + '">' + res.brand_unit +' '+ res.tipe_unit + '</option>');
                // var aa = count(res.id_user);
                //  console.log(xyz);

            } else {
                var element = document.getElementById("nama_user");
                element.classList.remove("is-invalid");
                element.classList.add("is-valid");
                document.getElementById("sef").disabled = false;
                // console.log('ok');
            }
            
         }
      }); 
    }
    }
</script>
@endsection
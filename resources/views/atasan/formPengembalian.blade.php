@extends('atasan.mainAtasan')

@section('formPengembalian')
active
@endsection

@section('hal')
Form Pengembalian
@endsection

@section('content')
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-8 col-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pengembalian</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" method="POST" action="{{ url('pengembalianAtasan') }}">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Nik</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="first-name" class="form-control" name="nik"
                                            placeholder="First Name" value="{{ session('id_pic') }}" readonly />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Nama</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="email" id="email-id" class="form-control" name="username"
                                            placeholder="Email" value="{{ session('username') }}" readonly />
                                    </div>

                                    <div class="col-md-3">
                                        <label>Jenis Unit</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select class="form-select" name="id_pengajuan" id="jnsUnt">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            @foreach ($dt_pinjaman as $item)
                                            <option value="{{ $item->id_pengajuan }}">{{ $item->nama_unit }} {{
                                                $item->brand_unit }} | {{ $item->tipe_unit }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tgl Pinjam</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="TglPinjam" class="form-control" name="TglPinjam"
                                            readonly />
                                    </div>
                                    <div class="col-md-3">
                                        <label>PIC Unit</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="picUnit" class="form-control" name="picUnit" readonly />
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Ket Pengajuan</label>
                                            <textarea name="ketPengajuan" class="form-control" id="ketPengajuan"
                                                rows="3" readonly /></textarea>
                                        </div>
                                    </div>
                                    <div class="divider">
                                        <div class="divider-text"><i data-feather="book"></i></div>
                                    </div>

                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Pengembalian <i
                                                class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $('#jnsUnt').change(function () {
   var r_id = $('#jnsUnt').val();
   if (r_id) {
      // jantan
    $.ajax({
         type: "GET",
         url: "/dataUnitPengembalian?id="+r_id,
         success: function (data) {
            if (data) {
               $("#TglPinjam").val("");
            $("#picUnit").val("");
            $("#id_pengajuan").val("");
            $("Textarea#ketPengajuan").val("");
               $.each(data, function (index, res) {
              
                  $("#TglPinjam").val(res.tgl_pengajuan);
                  $("#picUnit").val(res.nama_user);
                  $("#id_pengajuan").val(res.id_pengajuan);
                  $("Textarea#ketPengajuan").val(res.ket_pengajuan);
              
                //   console.log(data);
                });
            } else {
               $("#untBrg").empty();
            //    console.log(err);
            }
         }
      });
    }
    });
</script>
@endsection
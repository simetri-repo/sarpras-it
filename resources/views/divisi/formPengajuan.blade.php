@extends('divisi.mainDivisi')

@section('formPengajuan')
active
@endsection

@section('hal')
Form Pengajuan
@endsection

@section('content')
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-8 col-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pengajuan</h4>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" method="POST" action="{{ url('pengajuanUser') }}">
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
                                        <select class="form-select" name="kategoriUnit" id="jnsUnt" required>
                                            <option value="" selected disabled>-- Pilih --</option>
                                            @foreach ($dt_jenis as $item)
                                            <option value="{{ $item->id_jnsBarang }}">{{ $item->nama_jnsBarang }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Unit Barang</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select class="form-select" name="idUnit" id="untBrg">
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Nama Unit</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="namaUnit" class="form-control" name="namaUnit"
                                            readonly />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Brand Unit</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="brandUnit" class="form-control" name="brandUnit"
                                            readonly />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tipe Unit</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="tipeUnit" class="form-control" name="tipeUnit"
                                            readonly />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tahun Unit</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="tahunUnit" class="form-control" name="tahunUnit"
                                            readonly />
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Ket Unit</label>
                                            <textarea name="ketUnit" class="form-control" id="ketUnit" rows="3"
                                                readonly /></textarea>
                                        </div>
                                    </div>
                                    <div class="divider">
                                        <div class="divider-text"><i data-feather="book"></i></div>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Manager / Atasan</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select class="form-select" name="atasan" id="atasan" required>
                                            <option value="" selected disabled>-- Pilih --</option>
                                            @foreach ($atasan as $item)
                                            <option value="{{ $item->nik }}">{{ $item->nama_user }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Ket Pengajuan</label>
                                            <textarea name="ketPengajuan" class="form-control" id=""
                                                rows="3">{{ old('keterangan_unit') }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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

@section('style')
{{--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> --}}
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
<style>
    .selectpicker {
        background-color: aliceblue;
    }
</style>
@endsection


@section('script')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
<script>
    $(function () {
$('.selectpicker').selectpicker();
});
</script>
<script>
    $('#jnsUnt').change(function () {
   var r_id = $('#jnsUnt').val();
   if (r_id) {
      // jantan
    $.ajax({
         type: "GET",
         url: "/dataUnitById?id="+r_id,
         success: function (data) {
            if (data) {
               $("#untBrg").empty();
               $("#namaUnit").val("");
            $("#brandUnit").val("");
            $("#tipeUnit").val("");
            $("#tahunUnit").val("");
            $("Textarea#ketUnit").val("");
               $("#untBrg").append('<option selected disabled>-- PILIH --</option>');
               $.each(data, function (index, res) {
                  $("#untBrg").append('<option value="' + res.id_unit + '">' + res.nama_unit +' - ' +  res.tipe_unit +' - '+ res.brand_unit + '</option>');
                
                // $("#namaUnit").val(res.nama_unit);
                // $("#brandUnit").val(res.brand_unit);
                // $("#tipeUnit").val(res.tipe_unit);
                // $("Textarea#ketUnit").val(res.ket_unit);
                // $("#tahunUnit").val(res.tahun_unit);
                });

                $("#untBrg").change(function () {
                     var r_is = $('#untBrg').val();
                     if (r_is){
                         $.ajax({
                             type: "GET",
                             url: "/dataUnitByIdPart?id="+r_is,
                             success: function (data) {
                                 $.each(data, function (index, res) {
                                     $("#namaUnit").val(res.nama_unit);
                                    $("#brandUnit").val(res.brand_unit);
                                    $("#tipeUnit").val(res.tipe_unit);
                                    $("Textarea#ketUnit").val(res.ket_unit);
                                    $("#tahunUnit").val(res.tahun_unit);
                                 });
                             }
                         });
                     }
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
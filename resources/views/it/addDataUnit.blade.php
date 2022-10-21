@extends('it.mainIt')

@section('addDataUnit')
active
@endsection

@section('hal')
Add Data Unit
@endsection

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form add unit</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" action="{{ url('saveUnit') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Nama Unit</label>
                                        <input type="text" id="first-name-column"
                                            class="form-control @error('nama_unit') is-invalid @enderror"
                                            value="{{ old('nama_unit') }}" placeholder="Nama Unit" name="nama_unit">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Brand Unit</label>
                                        <input type="text" id="last-name-column"
                                            class="form-control @error('brand_unit') is-invalid @enderror"
                                            value="{{ old('brand_unit') }}" placeholder="Brand Unit" name="brand_unit">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="city-column">Tipe Unit</label>
                                        <input type="text" id="city-column"
                                            class="form-control @error('tipe_unit') is-invalid @enderror"
                                            value="{{ old('tipe_unit') }}" placeholder="Tipe Unit" name="tipe_unit">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="country-floating">Tahun Unit</label>
                                        <input type="text" id="country-floating"
                                            class="form-control @error('tahun_unit') is-invalid @enderror"
                                            name="tahun_unit" value="{{ old('tahun_unit') }}" placeholder="Tahun Unit"
                                            onkeypress="return validateNumber(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="company-column">Jenis Unit</label>
                                        <select class="form-select @error('jenis_unit') is-invalid @enderror"
                                            name="jenis_unit" id="basicSelect">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            @foreach ($jnsbrg as $item)
                                            <option value="{{ $item->id_jnsBarang }}">{{ $item->nama_jnsBarang }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email-id-column">Status Unit</label>
                                        <select class="form-select @error('status_unit') is-invalid @enderror"
                                            name="status_unit" id="pems" onChange="peminjaman(this)">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            @foreach ($statbrg as $item)
                                            <option value="{{ $item->id_statUnit }}">{{ $item->nama_statUnit }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6 col-12" id="pinjam" hidden>
                                    <h6>Peminjam</h6>
                                    <div class="form-group">
                                        <select class="choices form-select" name="peminjam">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            @foreach ($user as $item)
                                            <option value="{{ $item->nik }}">{{
                                                $item->nama_user }} - {{ $item->nik }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="email-id-column">Ket Unit</label>
                                        <textarea name="keterangan_unit" class="form-control" id=""
                                            rows="3">{{ old('keterangan_unit') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
<link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}" />
@endsection

@section('script')
<script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    function validateNumber(e) {
        const pattern = /^[0-9]$/;
        
        return pattern.test(e.key )
        }
</script>

<script>
    function peminjaman(value){
        var isi = $("#pems").val();
        // return console.log(isi);
        if (isi == 5) {
            document.getElementById("pinjam").hidden = false;
        } else {
            document.getElementById("pinjam").hidden = true;
        }
    }
</script>
@endsection
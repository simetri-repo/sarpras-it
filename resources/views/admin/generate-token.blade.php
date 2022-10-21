@extends('admin.mainAdmin')

@section('formPengajuan')
active
@endsection

@section('hal')
Generate Token
@endsection

@section('content')
<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-8 col-12 mx-auto">
            <div class="card">

                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" method="POST" action="{{ url('generate_token') }}">
                            @csrf
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-md-3">
                                        <label>Jumlah Token</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="email-id" class="form-control" name="generate"
                                            placeholder="Angka Jml Token" />
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
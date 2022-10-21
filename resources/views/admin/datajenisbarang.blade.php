@extends('admin.mainAdmin')

@section('datadivisi')
active
@endsection

@section('hal')
Jenis Barang
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
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Jenis Barang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>
                                <b>{{$item->nama_jnsBarang}}</b>
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning icon btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modelId{{ $item->id_jnsBarang }}">
                                    Edit
                                </button>
                                <!-- Modal -->
                                <div class="modal fade text-left" id="modelId{{ $item->id_jnsBarang }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel140" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title white" id="myModalLabel140">
                                                    Edit jenisbarang</h5>
                                                <button type="button" class="btn-close white" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form class="form form-horizontal" method="POST"
                                                action="{{ url('editjenisbarang/'. $item->id_jnsBarang ) }}">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Jenis Barang</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="first-name" class="form-control"
                                                                    name="jenisbarang_up"
                                                                    value="{{ $item->nama_jnsBarang }}" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- DELETE --}}
                                <button type="button" class="btn btn-danger icon btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#DelId{{ $item->id_jnsBarang }}">
                                    Delete
                                </button>
                                <!-- Modal -->
                                <div class="modal fade text-left" id="DelId{{ $item->id_jnsBarang }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel140" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title white" id="myModalLabel140">
                                                    Delete Data</h5>
                                                <button type="button" class="btn-close white" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="form-body">
                                                    Hapus <b>"{{ $item->nama_jnsBarang }}"</b> ?

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="{{ url('deletejenisbarang/'.$item->id_jnsBarang) }}"
                                                    class="btn btn-danger">
                                                    Delete</a>
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
<!-- Modal -->
<div class="modal fade text-left" id="modelId" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title white" id="myModalLabel140">
                    Add Jenis Barang</h5>
                <button type="button" class="btn-close white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal" method="POST" action="{{ url('savejenisbarang') }}">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Jenis Barang</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="first-name" class="form-control" name="jenisbarang"
                                    placeholder="Jenis Barang" required />
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
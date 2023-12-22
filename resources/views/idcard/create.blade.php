@extends('template.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="mt-5">
                    <form action="{{ url('idcard') }}" method="post" enctype="multipart/form-data">
                        <div class="mt-3 mb-3">
                            <a href="{{ url('idcard') }}" class="btn btn-sm btn-dark">Back</a>
                        </div>
                        @csrf
                        <div>
                            <div class=" mb-3">
                                <label for="nama">Nama</label>
                                <input name="nama" class="form-control" type="text">
                            </div>
                            <div class=" mb-3">
                                <label for="nip">NIP</label>
                                <input name="nip" class="form-control" type="text">
                            </div>
                            <label for="nip">Foto</label>
                            <div class="input-group mb-3">
                                <input name="foto" type="file" class="form-control">
                            </div>
                            <div class="mb-3">
                                    <button type="submit" class="btn btn-sm btn-primary btn-lg btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

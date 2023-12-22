@extends('template.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mt-5">
                {{-- <img style="max-width: 500px; max-height: 500px" src="{{ asset('hasil.jpg') }}" alt=""> --}}
                <p>Berhasil</p>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ url('idcard/' . $karyawan->id . '/open') }}" class="btn btn-dark">Lihat Idcard</a>
        </div>
    </div>
@endsection

@extends('template.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <a class="btn btn-primary" href="{{ url('idcard/create') }}">Add</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            {{-- <th>Foto</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data1->firstItem(); ?>
                        @foreach ($data1 as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nip }}</td>
                                {{-- <td>
                                    <img style="max-width: 50px; max-height: 50px" src="{{ asset('storage/'.$item->foto) }}" alt="Foto Karyawan">
                                </td> --}}
                                <td><a href="{{ url('idcard/' . $item->id) }}" class="btn btn-sm btn-success">Idcard</a></td>
                            </tr>
                            <?php $i++; ?>

                        @endforeach
                    </tbody>
                </table>
                {{ $data1->links() }}
            </div>
        </div>
    </div>
@endsection

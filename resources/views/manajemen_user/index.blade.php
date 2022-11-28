@extends('components.index')

@section('content')
    <a href="{{ route('masterKampus.showinsert') }}" class="btn btn-primary my-3">Tambah</a>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Nama kampus</th>
                    <th scope="col">Role</th>
               
                    <th scope="col">Aksi</th>

                </tr>
            </thead>
            <tbody>

               
                @foreach ($datas as $k)
                    <tr>
                     
                        <td>{{ $k->email }}</td>
                        <td>{{ $k->nama_kampus }}</td>
                        <td>{{ $k->role }}</td>
                       
                     

                        <td><a href="{{ route('ManajemenUser.hakAkses', ['id' => $k->id]) }}"
                                class="btn btn-primary">Hak Akses </a>
                            <!-- <a href="{{ route('masterKampus.delete', ['id' => $k->id]) }}" class="btn btn-danger"
                                onclick="confirm('Apakah anda yakin?')">Delete</a> -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

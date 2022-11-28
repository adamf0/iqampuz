@extends('components.index')

@section('content')
    <a href="{{ route('masterKampus.showinsert') }}" class="btn btn-primary my-3">Tambah</a>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nama kampus</th>
                    <th scope="col">Kode kampus</th>
                    <th scope="col">Logo Kampus</th>
                    <th scope="col">Alamat Kampus</th>
                    <th scope="col">Foto Kampus</th>
                    <th scope="col">Profil kampus</th>
                    <th scope="col">Warna kampus</th>
                    <th scope="col">Nama rektor</th>
                    <th scope="col">Foto rektor</th>
                    <th scope="col">Tgl kerjasama</th>
                    <th scope="col">Singkatan kampus</th>
                    <th scope="col">Akreditasi</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Tgl berdiri</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Kode pos</th>
                    <th scope="col">Faximile</th>
                    <th scope="col">Email</th>
                    <th scope="col">Website</th>
                    <th scope="col">Panel</th>
                    <th scope="col">Aksi</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($masterKampuses as $kampus)
                    <tr>
                        <td>{{ $kampus['nama_kampus'] }}</td>
                        <td>{{ $kampus['kode_kampus'] }}</td>
                        <td>
                            <img src="images/{{ $kampus['logo_kampus'] }}" class="img-fluid" alt="">
                        </td>
                        <td>{{ $kampus['alamat_kampus'] }}</td>
                        <td>
                            <img src="images/{{ $kampus['foto_kampus'] }}" class="img-fluid" alt="">
                        </td>
                        <td>{{ $kampus['profil_kampus'] }}</td>
                        <td><input type="color" class="border-0" value="{{ $kampus['warna_kampus'] }}" disabled></td>
                        <td>{{ $kampus['nama_rektor'] }}</td>
                        <td>
                            <img src="images/{{ $kampus['foto_rektor'] }}" class="img-fluid" alt="">
                        </td>
                        <td>{{ $kampus['tgl_kerjasama'] }}</td>
                        <td>{{ $kampus['singkatan_kampus'] }}</td>
                        <td>{{ $kampus['akreditasi'] }}</td>
                        <td>{{ $kampus['provinsi'] }}</td>
                        <td>{{ $kampus['tgl_berdiri'] }}</td>
                        <td>{{ $kampus['kota'] }}</td>
                        <td>{{ $kampus['telepon'] }}</td>
                        <td>{{ $kampus['kodepos'] }}</td>
                        <td>{{ $kampus['faximile'] }}</td>
                        <td>{{ $kampus['email'] }}</td>
                        <td>{{ $kampus['website'] }}</td>
                        <td>
                            @foreach ($hak_akses_kampus as $panel)
                                @if ($panel['id_kampus'] == $kampus['id'])
                                    @foreach ($panels as $paneldetail)
                                        @if ($paneldetail['id_panel'] == $panel['id_panel'])
                                            <li>{{ $paneldetail['nama_panel'] }}</li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </td>

                        <td><a href="{{ route('masterKampus.edit', ['id' => $kampus['id']]) }}"
                                class="btn btn-primary">Edit</a>
                            <a href="{{ route('masterKampus.delete', ['id' => $kampus['id']]) }}" class="btn btn-danger"
                                onclick="confirm('Apakah anda yakin?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

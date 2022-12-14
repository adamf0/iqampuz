@extends('components.index')

@section('content')
    <a href="{{ route('masterKampus.showinsert') }}" class="btn btn-sm btn-primary my-3 fw-semibold">Tambah</a>
    <div class="table-responsive">
        <table id="table_kampus" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <td scope="col">Nama kampus</td>
                    <td scope="col">Kode kampus</td>
                    <td scope="col">Logo Kampus</td>
                    <td scope="col">Alamat Kampus</td>
                    <td scope="col">Foto Kampus</td>
                    <td scope="col">Profil kampus</td>
                    <td scope="col">Warna kampus</td>
                    <td scope="col">Nama rektor</td>
                    <td scope="col">Foto rektor</td>
                    <td scope="col">Tgl kerjasama</td>
                    <td scope="col">Singkatan kampus</td>
                    <td scope="col">Akreditasi</td>
                    <td scope="col">Provinsi</td>
                    <td scope="col">Tgl berdiri</td>
                    <td scope="col">Kota</td>
                    <td scope="col">Telepon</td>
                    <td scope="col">Kode pos</td>
                    <td scope="col">Faximile</td>
                    <td scope="col">Email</td>
                    <td scope="col">Website</td>
                    <td scope="col">Panel</td>
                    <td scope="col">Aksi</td>

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
                        <td>
                            {{ Str::limit($kampus['alamat_kampus'], 50, '...') }}
                        </td>
                        <td>
                            <img src="images/{{ $kampus['foto_kampus'] }}" class="img-fluid" alt="">
                        </td>
                        <td>{{ Str::limit($kampus['profil_kampus'], 50, '...') }}</td>
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
                                class="btn btn-primary fw-semibold m-2">Edit</a>
                            <a href="{{ route('masterKampus.delete', ['id' => $kampus['id']]) }}"
                                class="btn btn-danger fw-semibold m-2" onclick="confirm('Apakah anda yakin?')">Delete</a>



                            <a href="{{ route('masterKampus.biaya.index', ['id' => $kampus['id']]) }}"
                                class="btn btn-success fw-semibold m-2">Detail biaya</a>

                            <a href="{{ route('masterKampus.gelombang.index', ['id' => $kampus['id']]) }}"
                                class="btn btn-primary">Gelombang</a>



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#table_kampus').DataTable({
                responsive: true
            });
        });
    </script>
@endsection

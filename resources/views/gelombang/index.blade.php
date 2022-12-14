@extends('components.index')

@section('content')
    <div class="shadow-sm p-5">

        <h1 class="text-center fw-semibold mb-4">Gelombang</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">nama gelombang</th>
                    <th scope="col">tanggal mulai</th>
                    <th scope="col">tanggal selesai</th>
                    <th scope="col">status</th>
                    <th scope="col">id kampus</th>
                    <th scope="col">tahun ajar</th>
                    <th scope="col">ujian seleksi</th>
                    <th scope="col">Aksi</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($datanya as $item)
                    <tr>
                        {{-- @foreach ($kampuses as $kampus)
                        @if ($item['id_kampus'] == $kampus['id'])
                            <td>{{ $kampus['nama_kampus'] }}</td>
                        @endif
                    @endforeach --}}
                        <td>{{ $item['nama_gelombang'] }}</td>
                        <td>{{ date('d F Y', strtotime($item['tgl_mulai'])) }}</td>
                        <td>{{ date('d F Y', strtotime($item['tgl_selesai'])) }}</td>
                        <td>{{ $item['status'] == 1 ? 'AKTIF' : 'TIDAK AKTIF' }}</td>
                        <td>{{ $item['id_kampus'] }}</td>
                        <td>{{ $item['tahun_ajar'] }}</td>
                        <td>{{ $item['ujian_seleksi'] == 1 ? 'AKTIF' : 'TIDAK AKTIF' }}</td>
                        <td>
                            <a href="{{ route('masterKampus.gelombang.edit', ['id' => $item['id_gelombang']]) }}"
                                class="btn btn-primary">Edit</a>
                            <a href="{{ route('masterKampus.gelombang.delete', ['id' => $item['id_gelombang']]) }}"
                                onclick="confirm('apakah anda yakin?')" class="btn btn-primary">Delete</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <form action="{{ route('masterKampus.gelombang.store') }}" method="post">
                        @csrf
                        <td>
                            <select class="form-select form-select-sm" name="gelombang" aria-label="Default select example">
                                <option value="gelombang 1">Gelombang 1</option>
                                <option value="gelombang 2">Gelombang 2</option>
                                <option value="gelombang 3">Gelombang 3</option>
                            </select>
                        </td>

                        <td>
                            <input type="date" class="form-control form-control-sm" name="tgl_mulai">
                        </td>
                        <td>
                            <input type="date" class="form-control form-control-sm" name="tgl_selesai">
                        </td>

                        <td>
                            <select class="form-select form-select-sm" name="status" aria-label="Default select example">
                                <option value="1">AKTIF</option>
                                <option value="0">TIDAK AKRIF</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm" name="id_kampus" aria-label="Default select example">
                                <option selected>PILIH KAMPUS</option>
                                @foreach ($kampuses as $kampus)
                                    <option value="{{ $kampus['id'] }}">{{ $kampus['nama_kampus'] }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" name="tahun_ajar"
                                placeholder="tahun ajar">
                        </td>
                        <td>
                            <select class="form-select form-select-sm" name="ujian_seleksi"
                                aria-label="Default select example">
                                <option value="1">AKTIF</option>
                                <option value="0">TIDAK AKRIF</option>
                            </select>
                        </td>


                        <td>
                            <button type="submit" class="btn btn-sm btn-primary fw-semibold">Tambah</button>
                        </td>
                    </form>

                </tr>
            </tbody>
        </table>

    </div>
@endsection

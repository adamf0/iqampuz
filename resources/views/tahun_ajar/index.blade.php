@extends('components.index')



@section('content')
    <div class="shadow-sm p-5">
        <h1 class="text-center fw-semibold mb-4">Tahun ajar</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">nama kampus</th>
                    <th scope="col">tahun ajar</th>
                    <th scope="col">status</th>
                    <th scope="col">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tahun_ajar as $item)
                    <tr>
                        {{-- @foreach ($kampuses as $kampus)
                            @if ($item['id_kampus'] == $kampus['id'])
                                <td>{{ $kampus['nama_kampus'] }}</td>
                            @endif
                        @endforeach --}}
                        <td>{{ $item['id_kampus'] }}</td>
                        <td>{{ $item['tahun_ajar'] }}</td>
                        <td>{{ $item['status'] == 1 ? 'AKTIF' : 'TIDAK AKTIF' }}</td>
                        <td>
                            <a href="{{ route('masterKampus.tahunajar.edit', ['id' => $item['id']]) }}"
                                class="btn btn-primary">Edit</a>
                            <a href="{{ route('masterKampus.tahunajar.delete', ['id' => $item['id']]) }}"
                                onclick="confirm('apakah anda yakin?')" class="btn btn-primary">Delete</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <form action="{{ route('masterKampus.tahunajar.store') }}" method="post">
                        @csrf
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
                            <select class="form-select form-select-sm" name="status" aria-label="Default select example">
                                <option value="1">AKTIF</option>
                                <option value="2">TIDAK AKRIF</option>
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

@extends('components.index')

@section('content')
    <div class="shadow-sm p-5">
        <form action="{{ route('masterKampus.gelombang.update', ['id' => $datanya['id_gelombang']]) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <label for="">Nama gelombang</label>
                    <select class="form-select form-select-sm" name="gelombang" aria-label="Default select example">
                        <option selected value="{{ $datanya['nama_gelombang'] }}">{{ $datanya['nama_gelombang'] }}</option>
                        <option value="gelombang 1">gelombang 1</option>
                        <option value="gelombang 2">gelombang 2</option>
                        <option value="gelombang 3">gelombang 3</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="">Tanggal mulai</label>
                    <input type="date" name="tgl_mulai" class="form-control" value="{{ $datanya['tgl_mulai'] }}">
                </div>
                <div class="col-12">
                    <label for="">Tanggal selesai</label>
                    <input type="date" name="tgl_selesai" class="form-control" value="{{ $datanya['tgl_selesai'] }}">
                </div>
                <div class="col-12">
                    <label for="">Status</label>
                    <select class="form-select form-select-sm" name="status" aria-label="Default select example">
                        <option selected value="{{ $datanya['status'] }}">
                            {{ $datanya['status'] == 1 ? 'AKTIF' : 'TIDAK AKTIF' }}</option>
                        <option value="1">AKTIF</option>
                        <option value="2">TIDAK AKRIF</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="">id kampus</label>
                    <input type="text" name="id_kampus" class="form-control" value="{{ $datanya['id_kampus'] }}">
                </div>
                <div class="col-12">
                    <label for="">tahun ajar</label>
                    <input type="text" name="tahun_ajar" class="form-control" value="{{ $datanya['tahun_ajar'] }}">
                </div>
                <div class="col-12">
                    <label for="">Ujian seleksi</label>
                    <select class="form-select form-select-sm" name="ujian_seleksi" aria-label="Default select example">
                        <option selected value="{{ $datanya['ujian_seleksi'] }}">
                            {{ $datanya['ujian_seleksi'] == 1 ? 'AKTIF' : 'TIDAK AKTIF' }}</option>
                        <option value="1">AKTIF</option>
                        <option value="2">TIDAK AKRIF</option>
                    </select>
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100">update</button>
                </div>
            </div>

        </form>
    </div>
@endsection

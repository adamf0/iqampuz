@extends('components.index')

@section('content')
    <div class="shadow-sm p-5">
        <form action="{{ route('masterKampus.tahunajar.update', ['id' => $datanya['id']]) }}" method="post">
            @csrf
            <input type="hidden" name="id_kampus" value="{{ $datanya['id_kampus'] }}">
            <div class="row">
                <div class="col-12">
                    <label for="">nama kampus</label>
                    @foreach ($kampuses as $kampus)
                        @if ($kampus['id'] == $datanya['id_kampus'])
                            <input type="text" class="form-control" value="{{ $kampus['nama_kampus'] }}" disabled>
                            <input type="hidden" name="id_kampus" class="form-control" value="{{ $datanya['id_kampus'] }}">
                        @endif
                    @endforeach
                </div>
                <div class="col-12">
                    <label for="">tahun ajar</label>
                    <input type="text" name="tahun_ajar" class="form-control" value="{{ $datanya['tahun_ajar'] }}">
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
                    <button type="submit" class="btn btn-primary w-100">update</button>
                </div>
            </div>

        </form>
    </div>
@endsection

@extends('components.index')

@section('content')
    <div class="shadow-sm p-5">
        @if (isset($ada))
            @foreach ($data_komponen as $data)
                <h1 class="text-center fw-semibold">List Komponen Biaya</h1>
                <form action="{{ route('masterKampus.biaya.update', ['id' => $id]) }}" method="post">
                    @csrf
                    <input type="hidden" name="id_komponen_biaya" value="{{ $data['id_komponen_biaya'] }}">
                    <div class="row justify-content-center my-5">
                        <div class="col-5">

                            <select class="form-select" aria-label="Default select example" name="komponen">
                                @foreach ($komponens as $komponen)
                                    @if ($data['id_komponen'] == $komponen['id_komponen'])
                                        <option class="bg-secondary" selected>{{ $komponen['nama_komponen'] }}</option>
                                    @endif
                                    <option value="{{ $komponen['id_komponen'] }}">{{ $komponen['nama_komponen'] }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-5">
                            <select class="form-select" aria-label="Default select example" name="gelombang">
                                <option selected>-- Gelombang --</option>
                                @foreach ($gelombangs as $gelombang)
                                    <option value="{{ $gelombang }}">{{ $gelombang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-5 mt-3">
                            Jurusan/Prodi
                        </div>
                        <div class="col-5 mt-3">
                            Biaya
                        </div>
                        <div class="col-5">
                            @foreach ($jurusan as $row)
                                <input class="form-control my-3" type="hidden" name="jurusan[]"
                                    value="{{ $row['kode'] }}">
                                <input class="form-control my-3" type="text"
                                    value="{{ $row['jenjang'] }} - {{ $row['nama'] }}" aria-label="Disabled input example"
                                    disabled>
                            @endforeach
                        </div>

                        <div class="col-5">
                            @php
                                $biayas = json_decode($data['biaya']);
                            @endphp
                            @foreach ($biayas as $biaya)
                                <input class="form-control my-3" name="biaya[]" value="{{ $biaya }}" type="text"
                                    placeholder='100000' aria-label="Disabled input example">
                            @endforeach
                        </div>

                        <div class="col-8">
                            <button type="submit" class="btn btn-sm fw-semibold btn-success w-100">Update</button>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('masterKampus.biaya.delete', ['id' => $data['id_komponen_biaya'], 'id_kampus' => $data['id_kampus']]) }}"
                                class="btn btn-sm fw-semibold btn-danger w-100"
                                onclick="confirm('Apakah anda yakin?')">Delete</a>
                        </div>

                    </div>
                </form>
            @endforeach
        @endif









        <div class="border p-3 bg-white shadow-sm">
            <h1 class="text-center fw-semibold">Tambah Komponen Biaya</h1>
            <form action="{{ route('masterKampus.biaya.store', ['id' => $id]) }}" method="post">
                @csrf

                <div class="row justify-content-center my-5">
                    <div class="col-5">

                        <select class="form-select" aria-label="Default select example" name="komponen">
                            <option selected>-- pilih komponen --</option>
                            @foreach ($komponens as $komponen)
                                <option value="{{ $komponen['id_komponen'] }}">{{ $komponen['nama_komponen'] }}</option>
                            @endforeach
                        </select>

                    </div>


                    <div class="col-5">
                        @if ($gelombangs !== 'false')
                            <select class="form-select" aria-label="Default select example" name="gelombang">
                                <option selected>-- Gelombang --</option>
                                @foreach ($gelombangs as $gelombang)
                                    <option value="{{ $gelombang['id_gelombang'] }}">{{ $gelombang['nama_gelombang'] }}
                                        ({{ date('d-F-Y', strtotime($gelombang['tgl_mulai'])) }} -
                                        {{ date('d-F-Y', strtotime($gelombang['tgl_selesai'])) }})
                                    </option>
                                @endforeach

                            </select>
                        @else
                            <a href="{{ route('masterKampus.gelombang.index', ['id' => $id]) }}""
                                class="btn btn-sm btn-primary fw-semibold">
                                Buat
                                gelombang
                            </a>
                        @endif
                    </div>

                    <div class="col-5 mt-3">
                        Jurusan/Prodi
                    </div>
                    <div class="col-5 mt-3">
                        Biaya
                    </div>
                    <div class="col-5">
                        @foreach ($jurusan as $row)
                            <input class="form-control my-3" type="hidden" name="jurusan[]" value="{{ $row['kode'] }}">
                            <input class="form-control my-3" type="text"
                                value="{{ $row['jenjang'] }} - {{ $row['nama'] }}" aria-label="Disabled input example"
                                disabled>
                        @endforeach
                    </div>

                    <div class="col-5">
                        @for ($i = 0; $i < count($jurusan); $i++)
                            <input class="form-control my-3" name="biaya[]" type="text" placeholder='100000'
                                aria-label="Disabled input example">
                        @endfor
                    </div>

                    <div class="col-10">
                        <button type="submit" class="btn btn-primary w-100">Tambah</button>
                    </div>

                </div>



            </form>
        </div>

    </div>
@endsection

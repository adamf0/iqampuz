@extends('components.index')

@section('content')
    <a href="{{ route('masterKampus.index') }}" class="btn btn-primary my-3">Back</a>
    <div class="col-12 mb-5 m-auto shadow-sm p-4">
        <form action="{{ route('masterKampus.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6 my-1">
                    <label for="nama" class="form-label">Nama Kampus</label>
                    <input type="text" name="nama_kampus" class="form-control" id="nama">
                </div>
                <div class="col-6 my-1">
                    <label for="logo_kampus" class="form-label">Logo Kampus</label>
                    <input type="file" name="logo_kampus" class="form-control" id="logo_kampus">
                </div>
                <div class="col-6 my-1">
                    <label for="kode" class="form-label">Kode Kampus</label>
                    <input type="text" name="kode_kampus" class="form-control" id="kode">
                </div>
                <div class="col-6 my-1">
                    <label for="singkatan_kampus" class="form-label">Singkatan Kampus</label>
                    <input type="text" name="singkatan_kampus" class="form-control" id="singkatan_kampus">
                </div>
                <div class="col-6 my-1">
                    <label for="tanggal_berdiri" class="form-label">Tanggal berdiri</label>
                    <input type="date" name="tanggal_berdiri" class="form-control" id="tanggal_berdiri">
                </div>
                <div class="col-6 my-1">
                    <label for="provinsi" class="form-label">Provinsi</label>
                    <input type="text" name="provinsi" class="form-control" id="provinsi">
                </div>
                <div class="col-6 my-1">
                    <label for="kota" class="form-label">Kota</label>
                    <input type="text" name="kota" class="form-control" id="kota">
                </div>
                <div class="col-6 my-1">
                    <label for="kode_pos" class="form-label">Kode Pos</label>
                    <input type="text" name="kode_pos" class="form-control" id="kode_pos">
                </div>
                <div class="col-6 my-1">
                    <label for="faximile" class="form-label">Maximile</label>
                    <input type="text" name="faximile" class="form-control" id="faximile">
                </div>
                <div class="col-6 my-1">
                    <label for="akreditasi" class="form-label">Akreditasi</label>
                    <input type="text" name="akreditasi" class="form-control" id="akreditasi">
                </div>
                <div class="col-6 my-1">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" name="telepon" class="form-control" id="telepon">
                </div>
                <div class="col-6 my-1">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email">
                </div>
                <div class="col-6 my-1">
                    <label for="website" class="form-label">Website</label>
                    <input type="text" name="website" class="form-control" id="website">
                </div>

                <div class="col-6 my-1">
                    <label for="tgl_kerjasama" class="form-label">Tanggal Kerja Sama</label>
                    <input type="date" name="tgl_kerjasama" class="form-control" id="tgl_kerjasama">
                </div>

                <div class="col-6 my-1">
                    <label for="nama_rektor" class="form-label">Nama Rektor</label>
                    <input type="text" name="nama_rektor" class="form-control" id="nama_rektor">
                </div>
                <div class="col-6 my-1">
                    <label for="foto_rektor" class="form-label">Foto Rektor</label>
                    <input type="file" name="foto_rektor" class="form-control" id="foto_rektor">
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat kampus</label>
                    <textarea class="form-control" name="alamat_kampus" id="alamat" rows="3"></textarea>
                </div>
                <div class="col-12">
                    <label for="profil_kampus" class="form-label">Profil kampus</label>
                    <textarea class="form-control" name="profil_kampus" id="profil_kampus" rows="3"></textarea>
                </div>
                <div class="col-6 my-1">
                    <label for="foto_kampus" class="form-label">Foto kampus</label>
                    <input type="file" name="foto_kampus" class="form-control" id="foto_kampus">
                </div>
                <div class="col-6 my-1">
                    <label for="warna_kampus" class="form-label">Warna/Tema kampus</label>
                    <input type="color" name="warna_kampus" class="form-control form-control-color w-100 p-2 border-0"
                        id="warna_kampus" value="#FFEA00">
                </div>
                <div class="col-12 my-1">
                    <h6 class="my-3">Hak akses</h6>
                </div>
                @foreach ($panels as $panel)
                    <div class="col-6 my-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $panel['id_panel'] }}">
                            <label class="form-check-label">
                                {{ $panel['nama_panel'] }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>


            <button type="submit" name="submit" class="btn btn-primary w-100 fm-semibold mt-3">Submit</button>
    </div>

    </form>

    </div>
@endsection

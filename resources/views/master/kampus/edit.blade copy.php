@extends('components.index')

@section('content')
<a href="{{ route('masterKampus.index') }}" class="btn btn-primary my-3">Back</a>
<div class="col-12 mb-3 m-auto shadow-sm p-4">

    <form action="{{ route('masterKampus.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            @foreach ($detailKampus as $detail)
            <input type="hidden" name="id" value="{{ $detail['id'] }}">
            <div class="col-6 my-1">
                <label for="nama" class="form-label">Nama Kampus</label>
                <input type="text" name="nama_kampus" class="form-control" id="nama" value="{{ $detail['nama_kampus'] }}">
            </div>
            <div class="col-6 my-1">
                <label for="logo_kampus" class="form-label"><b class="text-danger">*</b> Logo Kampus</label>

                <div class="row">
                    <div class="col-6">
                        <img src="images/{{ $detail['logo_kampus'] }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-6">
                        <input type="file" name="logo_kampus" class="form-control" id="logo_kampus" value="{{ $detail['logo_kampus'] }}">
                    </div>
                </div>

            </div>
            <div class="col-6 my-1">
                <label for="kode" class="form-label">Kode Kampus</label>
                <input type="text" name="kode_kampus" class="form-control" id="kode" value="{{ $detail['kode_kampus'] }}">
            </div>
            <div class="col-6 my-1">
                <label for="singkatan_kampus" class="form-label">Singkatan Kampus</label>
                <input type="text" name="singkatan_kampus" class="form-control" id="singkatan_kampus" value="{{ $detail['singkatan_kampus'] }}">
            </div>
            <div class="col-6 my-1">
                <label for="tanggal_berdiri" class="form-label">Tanggal berdiri</label>
                <input type="date" name="tanggal_berdiri" class="form-control" id="tanggal_berdiri" value="{{ $detail['tgl_berdiri'] }}">
            </div>
            <div class="col-6 my-1">
                <label for="provinsi" class="form-label">Provinsi</label>

                <input type="text" name="provinsi" class="form-control" id="provinsi" value="{{ $detail['provinsi'] }}">
            </div>
            <div class="col-6 my-1">
                <label for="kota" class="form-label">Kota</label>
                <input type="text" name="kota" class="form-control" id="kota" value="{{ $detail['kota'] }}">
            </div>
            <div class="col-6 my-1">
                <label for="kode_pos" class="form-label">Kode Pos</label>
                <input type="text" name="kode_pos" class="form-control" id="kode_pos" value="{{ $detail['kodepos'] }}">
            </div>
            <div class="col-6 my-1">
                <label for="faximile" class="form-label">Maximile</label>
                <input type="text" name="faximile" class="form-control" id="faximile" value="{{ $detail['faximile'] }}">
            </div>
            <div class="col-6 my-1">
                <label for="akreditasi" class="form-label">Akreditasi</label>
                <input type="text" name="akreditasi" class="form-control" id="akreditasi" value="{{ $detail['akreditasi'] }}">
            </div>
            <div class="col-6 my-1">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control" id="telepon" value="{{ $detail['telepon'] }}">
            </div>
            <div class="col-6 my-1">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" id="email" value="{{ $detail['email'] }}">
            </div>
            <div class="col-6 my-1">
                <label for="website" class="form-label">Website</label>
                <input type="text" name="website" class="form-control" id="website" value="{{ $detail['website'] }}">
            </div>

            <div class="col-6 my-1">
                <label for="tgl_kerjasama" class="form-label">Tanggal Kerja Sama</label>
                <input type="date" name="tgl_kerjasama" class="form-control" id="tgl_kerjasama" value="{{ $detail['tgl_kerjasama'] }}">
            </div>

            <div class="col-6 my-1">
                <label for="nama_rektor" class="form-label">Nama Rektor</label>
                <input type="text" name="nama_rektor" class="form-control" id="nama_rektor" value="{{ $detail['nama_rektor'] }}">
            </div>
            <div class="col-6 my-1">
                <label for="warna_kampus" class="form-label">Warna/Tema kampus</label>
                <input type="color" name="warna_kampus" class="form-control form-control-color w-100 p-2 border-0" id="warna_kampus" value="{{ $detail['warna_kampus'] }}">
            </div>

            <div class="col-12 my-1">
                <label for="alamat" class="form-label">Alamat kampus</label>
                <textarea class="form-control" name="alamat_kampus" id="alamat" rows="3">{{ $detail['alamat_kampus'] }}</textarea>
            </div>
            <div class="col-12 my-1">
                <label for="profil_kampus" class="form-label">Profil kampus</label>
                <textarea class="form-control" name="profil_kampus" id="profil_kampus" rows="3">{{ $detail['profil_kampus'] }}</textarea>
            </div>
            <div class="col-6 my-1">
                <label for="foto_kampus" class="form-label"><b class="text-danger">*</b> Foto kampus</label>
                <div class="row">
                    <div class="col-6">
                        <img src="images/{{ $detail['foto_kampus'] }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-6">
                        <input type="file" name="foto_kampus" class="form-control" id="foto_kampus" value="{{ $detail['foto_kampus'] }}">
                    </div>
                </div>

            </div>
            <div class="col-6 my-1">
                <label for="foto_rektor" class="form-label"><b class="text-danger">*</b> Foto Rektor</label>
                <div class="row">
                    <div class="col-6">
                        <img src="images/{{ $detail['foto_rektor'] }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-6">
                        <input type="file" name="foto_rektor" class="form-control" id="foto_rektor" value="{{ $detail['foto_rektor'] }}">
                    </div>
                </div>

            </div>
            @endforeach



            <button type="submit" name="submit" class="btn btn-primary w-100 fm-semibold mt-3">Update</button>
        </div>

    </form>

</div>
@endsection

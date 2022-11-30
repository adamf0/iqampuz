<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10 d-flex p-5">
            <h1 class="text-center">Form Tambah Komponen Pembayaran</h1>
            <hr>
        </div>
        <div class="col-10 d-flex">
            @if(Session::has('msg'))
                <div class="col-10">
                    {{ Session::get('msg') }}
                </div>
            @endif
            <form action="{{ route('master_komponen.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label>Nama Komponen</label>
                        <input type="text" class="form-control" name="nama_komponen">
                        @if($errors->has('nama_komponen'))
                            <div class="text-danger">{{ $errors->first('nama_komponen') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
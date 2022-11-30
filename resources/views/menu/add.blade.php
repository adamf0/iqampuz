<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10 d-flex p-5">
            <h1 class="text-center">Form Tambah Menu</h1>
            <hr>
        </div>
        <div class="col-10 d-flex">
            @if(Session::has('msg'))
                <div class="col-10">
                    {{ Session::get('msg') }}
                </div>
            @endif
            <form action="{{ route('menu.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label>Nama Menu</label>
                        <input type="text" class="form-control" name="nama_menu">
                        @if($errors->has('nama_menu'))
                            <div class="text-danger">{{ $errors->first('nama_menu') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label>Posisi</label>
                        <select class="form-control" name="posisi">
                            <option value="Kiri">Kiri</option>
                            <option value="Kanan">Kanan</option>
                            <option value="Atas">Atas</option>
                        </select>
                        @if($errors->has('posisi'))
                            <div class="text-danger">{{ $errors->first('posisi') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label>Status Menu</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Aktif</label>
                        </div>
                        @if($errors->has('status'))
                            <div class="text-danger">{{ $errors->first('status') }}</div>
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
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10 d-flex p-5">
            <h1 class="text-center">Form Ubah Komponen Pembayaran</h1>
            <hr>
        </div>
        <div class="col-10 d-flex">
            @if(Session::has('msg'))
                <div class="col-10">
                    {{ Session::get('msg') }}
                </div>
            @endif
            <form action="{{ route('master_komponen.update',['id'=>$komponen->id_komponen]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label>Nama Komponen Pembayaran</label>
                        <input type="text" class="form-control" name="nama_komponen" value="{{ $komponen->nama_komponen }}">
                        @if($errors->has('nama_komponen'))
                            <div class="text-danger">{{ $errors->first('nama_komponen') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <input type="submit" name="update" value="Update" class="btn btn-warning">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
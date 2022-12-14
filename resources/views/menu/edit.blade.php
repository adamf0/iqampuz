<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10 d-flex p-5">
            <h1 class="text-center">Form Ubah Menu</h1>
            <hr>
        </div>
        <div class="col-10 d-flex">
            @if(Session::has('msg'))
                <div class="col-10">
                    {{ Session::get('msg') }}
                </div>
            @endif
            <form action="{{ route('menu.update',['id'=>$menu->id_menu]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label>Nama Menu</label>
                        <input type="text" class="form-control" name="nama_menu" value="{{ $menu->nama_menu }}">
                    </div>
                    <div class="col-12">
                        <label>Posisi</label>
                        <select class="form-control" name="posisi">
                            <option value="Kiri" @if($menu->posisi=="kiri") selected @endif>Kiri</option>
                            <option value="Kanan" @if($menu->posisi=="kanan") selected @endif>Kanan</option>
                            <option value="Atas" @if($menu->posisi=="atas") selected @endif>Atas</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label>Status Menu</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckDefault" @if($menu->status==1) checked @endif>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Aktif</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="update" value="Update" class="btn btn-warning">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- <script>
    function changeStatus(e){
        var x = $(".form-check-label").attr("checked");
        console.log(x)
        // $('').text(e.value? 'Aktif':'Non-aktif');
    }
</script> -->
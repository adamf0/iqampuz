
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10 d-flex p-5">
            <h1 class="text-center">Form Ubah Panel Menu</h1>
            <hr>
        </div>
        <div class="col-10 d-flex">
            @if(Session::has('msg'))
                <div class="col-10">
                    {{ Session::get('msg') }}
                </div>
            @endif
            <form action="{{ route('panel_menu.update',['id'=>$data->id_menu_panel]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label>Nama Panel</label>
                        <select class="form-control" name="id_panel" id="id_panel" onchange="load_menus(this)">
                            <option value="">-- Pilih Panel --</option>
                            @foreach($panels as $panel)
                                <option value="{{ $panel->id_panel }}" @if($panel->id_panel==$data->id_panel) selected @endif>{{ $panel->nama_panel }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('id_panel'))
                            <div class="error">{{ $errors->first('id_panel') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label>Nama Menu</label>
                        <select class="form-control" name="id_menu" id="menus">
                            <option value="">-- Pilih Menu --</option>
                        </select>
                        @if($errors->has('id_menu'))
                            <div class="error">{{ $errors->first('id_menu') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label>To Menu</label>
                        <input type="text" class="form-control" name="to_menu" value="{{ $data->to_menu }}">
                        @if($errors->has('to_menu'))
                            <div class="error">{{ $errors->first('to_menu') }}</div>
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    let options = ``;
    var token =  $('input[name="_token"]').attr('value'); 
    var id_panel = "{{ $data->id_panel }}";

    function load_menus(id_panel){
        var id_panel = id_panel!=""? id_panel:id_panel.options[id_panel.selectedIndex].value;
        console.log(id_panel);
        $("#menus").empty()

        $.ajax({
            type: "POST",  
            url: "{{ route('panel_menu.available_menu') }}",
            dataType: "json",
            accepts: {
                text: "application/json"
            },
            headers: {
                'X-CSRF-Token': token 
            },
            data:{
                id_panel: id_panel
            },
            success: function(responses){  
                options = `<option value="">-- Pilih Menu --</option>`;
                options += `<option value="{{ $data->id_menu }}" selected>{{ $data->menu->nama_menu }}</option>`;
                $.each(responses, function(idx, row) {
                    options += `<option value="${row.id_menu}">${row.nama_menu}</option>`;
                })
                $("#menus").append(options);  
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                options = `<option value="">-- Pilih Menu --</option>`;
                options += `<option value="{{ $data->id_menu }}" selected>{{ $data->menu->nama_menu }}</option>`;
                $("#menus").append(options);
            }       
        });
    }

    load_menus(id_panel);
</script>


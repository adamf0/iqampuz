@extends('components.index')

@section('content')
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
                            <div class="text-danger">{{ $errors->first('id_panel') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label>Nama Menu</label>
                        <select class="form-control" name="id_menu" id="menus">
                            <option value="">-- Pilih Menu --</option>
                        </select>
                        @if($errors->has('id_menu'))
                            <div class="text-danger">{{ $errors->first('id_menu') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label>To Menu</label>
                        <input type="text" class="form-control" name="to_menu" value="{{ $data->to_menu }}">
                        @if($errors->has('to_menu'))
                            <div class="text-danger">{{ $errors->first('to_menu') }}</div>
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
@endsection
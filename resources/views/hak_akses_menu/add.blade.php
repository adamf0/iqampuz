@extends('components.index')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10 d-flex p-5">
            <h1 class="text-center">Form Tambah Hak Akses Menu</h1>
            <hr>
        </div>
        <div class="col-10 d-flex">
            @if(Session::has('msg'))
                <div class="col-10">
                    {{ Session::get('msg') }}
                </div>
            @endif
            <form action="{{ route('hak_akses_menu.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label>Kampus</label>
                        <select class="form-control" name="id_kampus" id="id_kampus" style="width: 100%;"></select>
                        @if($errors->has('id_kampus'))
                            <div class="text-danger">{{ $errors->first('id_kampus') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label>Role</label>
                        <select class="form-control" name="id_role" id="id_role" style="width: 100%;"></select>
                        @if($errors->has('id_role'))
                            <div class="text-danger">{{ $errors->first('id_role') }}</div>
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
    function get(url,element){
        $.ajax({
            type: "GET",  
            url: url,
            accept: 'application/json',
            dataType: 'json',
            success: function(response){  
                var response_ = {id: -1,text: '',selected: 'selected',search:'',hidden:true};
                response_ = [response_].concat(response);

                $(`#${element}`).select2({
                    allowClear: true,
                    placeholder: {
                        id: "-1",
                        text:"-- Pilih --",
                        selected:'selected'
                    },
                    data: response_
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                // alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }       
        });
    }

    $(document).ready(function() {
        get('{{ route("utility",["type"=>"kampus"]) }}','id_kampus');
        get('{{ route("utility",["type"=>"rolw"]) }}','id_role');
    });
</script>
@endsection
@extends('components.index')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10 d-flex p-5">
            <h1 class="text-center">Form Ubah Panel</h1>
            <hr>
        </div>
        <div class="col-10 d-flex">
            @if(Session::has('msg'))
                <div class="col-10">
                    {{ Session::get('msg') }}
                </div>
            @endif
            <form action="{{ url('panel/update/'.$panel->id_panel) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label>Nama Panel</label>
                        <input type="text" class="form-control" name="nama_panel" value="{{ $panel->nama_panel }}">
                    </div>
                    <div class="col-12">
                        <label>Status Panel</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckDefault" @if($panel->status==1) checked @endif>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Aktif</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Logo</label>
                        <br>
                        <img src="<?php echo url('public/panel/'.$panel->logo); ?>" alt="logo" height="200" width="200">
                        <input type="hidden" name="old_logo" value="{{ $panel->logo }}">
                        <input type="file" class="form-control" name="logo">
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
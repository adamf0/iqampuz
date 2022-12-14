@extends('components.index')

@section('content')
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
@endsection

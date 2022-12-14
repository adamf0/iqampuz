@extends('components.index')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center d-flex">
        <div class="col-10 p-5">
            <h1 class="text-center">Panel</h1>
            <hr>
        </div>
        @if(Session::has('msg'))
        <div class="col-10">
            {{ Session::get('msg') }}
        </div>
        @endif
        <div class="col-10">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <td>#</td>
                        <td>Nama Panel</td>
                        <td>Logo</td>
                        <td>Status</td>
                        <td>Aksi</td>
                    </tr>
                    @php $i=1; @endphp
                    @foreach($datas as $data)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $data->nama_panel }}</td>
                        <td><img src="{{ asset('img_panel/'.$data->logo) }}" alt="logo" width="80" height="80" /></td>
                        <td>{{ $data->status? "Aktif":"Non-aktif" }}</td>
                        <td><a href='<?php echo route("panel.edit", ["id" => $data->id_panel]) ?>' class="btn btn-warning">Ubah</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
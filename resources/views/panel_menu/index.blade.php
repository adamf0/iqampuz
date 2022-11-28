@extends('components.index')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">

<div class="container-fluid">
    <div class="row justify-content-center d-flex">
        <div class="col-10 p-5">
            <h1 class="text-center">Panel Menu</h1>
            <hr>
        </div>
        @if(Session::has('msg'))
        <div class="col-10">
           {{ Session::get('msg') }}
        </div>
        @endif
        <div class="col-10">
            <a href="{{ route('panel_menu.create') }}" class="btn btn-primary">Tambah Menu</a>
            <table class="table table-responsive">
                <tr>
                    <td>#</td>
                    <td>Nama Panel</td>
                    <td>Nama Menu</td>
                    <td>To Menu</td>
                    <td>Aksi</td>
                </tr>
                @php $i=1; @endphp
                @foreach($datas as $data)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $data->panel->nama_panel }}</td>
                    <td>{{ $data->menu->nama_menu }}</td>
                    <td>{{ $data->to_menu }}</td>
                    <td>
                        <a href='<?php echo route("panel_menu.edit",["id"=>$data->id_menu_panel]) ?>' class="btn btn-warning">Ubah</a>
                        <a href='#' class="btn btn-danger" onclick="return konfirmasi_hapus('{{ $data->id_menu_panel }}','{{ $data->panel->nama_panel }}','{{ $data->menu->nama_menu }}')">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="{{ asset('js/jquery.redirect.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });

    function konfirmasi_hapus(id,nama_panel,nama_menu){
        console.log(id)
        console.log(nama_panel)
        console.log(nama_menu)

        swalWithBootstrapButtons.fire({
            title: 'Konfirmasi',
            text: `anda yakin ingin menghapus menu ${nama_menu} di panel ${nama_panel}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            reverseButtons: true
        })
        .then((result) => {
            if (result.isConfirmed) {
                $.redirect(`http://localhost:8000/panel_menu/delete/${id}`, {}, 'GET');
            } else if (result.dismiss === Swal.DismissReason.cancel) {}
        })
    }
</script>
@endsection

@extends('components.index')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center d-flex">
        <div class="col-10 p-5">
            <h1 class="text-center">Menu</h1>
            <hr>
        </div>
        @if(Session::has('msg'))
        <div class="col-10">
           {{ Session::get('msg') }}
        </div>
        @endif
        <div class="col-10">
            <a href="{{ route('menu.create') }}" class="btn btn-primary">Tambah Menu</a>
            <table class="table table-responsive">
                <tr>
                    <td>#</td>
                    <td>Nama Menu</td>
                    <td>Posisi Menu</td>
                    <td>Status</td>
                    <td>Aksi</td>
                </tr>
                @php $i=1; @endphp
                @foreach($datas as $data)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $data->nama_menu }}</td>
                    <td>{{ $data->posisi }}</td>
                    <td>{{ $data->status? "Aktif":"Non-aktif" }}</td>
                    <td>
                        <a href='<?php echo route("menu.edit",["id"=>$data->id_menu]) ?>' class="btn btn-warning">Ubah</a>
                        <a href='#' class="btn btn-danger" onclick="return konfirmasi_hapus('{{ $data->id_menu }}','{{ $data->nama_menu }}')">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<script>
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });

    function konfirmasi_hapus(id,nama){
        console.log(id)
        console.log(nama)

        swalWithBootstrapButtons.fire({
            title: 'Konfirmasi',
            text: `anda yakin ingin menghapus menu ${nama}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            reverseButtons: true
        })
        .then((result) => {
            if (result.isConfirmed) {
                $.redirect(`http://localhost:8000/menu/delete/${id}`, {}, 'GET');
            } else if (result.dismiss === Swal.DismissReason.cancel) {}
        })
    }
</script>
@endsection
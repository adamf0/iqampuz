@extends('components.index')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center d-flex">
        <div class="col-10 p-5">
            <h1 class="text-center">Komponen Pembayaran</h1>
            <hr>
        </div>
        @if(Session::has('msg'))
        <div class="col-10">
           {{ Session::get('msg') }}
        </div>
        @endif
        <div class="col-10">
            <a href="{{ route('master_komponen.create') }}" class="btn btn-primary">Tambah Komponen Pembayaran</a>
            <table class="table table-responsive">
                <tr>
                    <td>#</td>
                    <td>Nama Komponen</td>
                    <td>Aksi</td>
                </tr>
                @php $i=1; @endphp
                @foreach($datas as $data)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $data->nama_komponen }}</td>
                    <td>
                        <a href='<?php echo route("master_komponen.edit",["id"=>$data->id_komponen]) ?>' class="btn btn-warning">Ubah</a>
                        <a href='#' class="btn btn-danger" onclick="return konfirmasi_hapus('{{ $data->id_komponen }}','{{ $data->nama_komponen }}')">Hapus</a>
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
            text: `anda yakin ingin menghapus komponen pembayaran ${nama}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            reverseButtons: true
        })
        .then((result) => {
            if (result.isConfirmed) {
                $.redirect(`http://localhost:8000/master_komponen/delete/${id}`, {}, 'GET');
            } else if (result.dismiss === Swal.DismissReason.cancel) {}
        })
    }
</script>
@endsection
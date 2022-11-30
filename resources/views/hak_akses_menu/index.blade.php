@extends('components.index')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center d-flex">
        <div class="col-10 p-5">
            <h1 class="text-center">Hak Akses Menu</h1>
            <hr>
        </div>
        @if(Session::has('msg'))
        <div class="col-10">
           {{ Session::get('msg') }}
        </div>
        @endif
        <div class="col-10">
            <table class="table table-responsive">
                <tr>
                    <td>#</td>
                    <td>Kampus</td>
                    <td>Role</td>
                    <td>Panel</td>
                    <td>Menu</td>
                    <!-- <td>Aksi</td> -->
                </tr>
                @php $i=1; @endphp
                @foreach($datas as $group_kampus => $roles)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $group_kampus }}</td>
                        @foreach($roles as $group_role => $panels)
                            <td>{{ $group_role }}</td>
                            @foreach($panels as $group_panel => $menus)
                                <td>{{ $group_panel }}</td>
                                <td>
                                    <ul>
                                    @forelse ($menus as $menu)
                                        <li>{{ $menu->nama_menu }}</li>
                                    @empty
                                        <li>Tidak ada menu</li>
                                    @endforelse
                                    </ul>
                                </td>
                            @endforeach
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
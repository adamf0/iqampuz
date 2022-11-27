<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

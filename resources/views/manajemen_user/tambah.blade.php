@extends('components.index')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="card container" style="height:700px;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-10 d-flex p-5">
                <h1 class="text-center">Form User</h1>
                <hr>
            </div>
            <div class="col-10 d-flex">
                @if(Session::has('msg'))
                <div class="col-10">
                    {{ Session::get('msg') }}
                </div>
                @endif
                <form action="{{ route('ManajemenUser.insert') }}" method="post">
                    @csrf
                    <div class="row ">
                        <div class="col-6 my-1">
                            <label for="nama" class="form-label">Nama Kampus</label>
                            <br>
                            <select class="form-control" name="id_kampus">
                                @foreach ($kampus as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kampus }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 my-1">
                            <label for="nama" class="form-label">Role </label>
                            <br>
                            <select class="form-control" name="id_role">
                                @foreach ($role as $r)
                                <option value="{{ $r->id }}">{{ $r->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 my-1">
                            <label for="username" class="form-label">Email</label>
                            <input type="text" required name="email" class="form-control" id="username">
                        </div>
                        <div class="col-6 my-1">
                            <label for="password"  class="form-label">Password</label>
                            <input type="password" minlength="6" maxlength="6" required name="password" class="form-control" id="tanggal_berdiri">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
@endsection
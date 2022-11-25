@extends('components.index')

@section('content')
    <div class="col-6 my-5 m-auto">

        <form action="{{ route('auth.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h6>{{ $errors }}</h6>
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100 fm-semibold">Login</button>
        </form>

    </div>
@endsection

@extends("layouts.app")
@section("content")

@if (session("status"))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> <!-- Include the SweetAlert library -->
    <script>
        swal({
            title: "Invalid!",
            text: "{{ session("status") }}",
            icon: "error",
            button: "Okay",
        });
    </script>
@endif

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Login</h2>
                    <form action="{{route("login")}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" >
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" >
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input name="remember" type="checkbox" class="form-check-input" id="remember">
                            <label  class="form-check-label" for="remember">Remember me</label>
                            @error('remember')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <p class="message col d-flex justify-content-end"> <a href="{{ route("registration") }}">Create an account</a></p>
                        <div class="text-center row d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary col-lg-6 ">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
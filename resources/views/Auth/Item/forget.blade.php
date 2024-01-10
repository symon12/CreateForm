

@extends("layouts.app")
@section("content")

@if (session("error"))
<div class="alert alert-danger">{{session("error")}} </div>
    
@endif


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Update Password
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route("forget")}}">
                        @csrf
                        <div class="mb-3">
                            <label  for="oldPassword" class="form-label">Old Password</label>
                            <input name="oldPassword" type="password" class="form-control" id="oldPassword" >
                            @error('oldPassword')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input name="password" type="password" class="form-control" id="newPassword" >
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input name="password_confirmation" type="password" class="form-control" id="confirmPassword" >
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
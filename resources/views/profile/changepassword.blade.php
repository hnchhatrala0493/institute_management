@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('password.updatepassword',['user'=>Auth::user()->id])}}" method="post">
            <input type="hidden" name="password" value="{{$profile->password}}"/>
            @csrf
            <div class="mb-3 mt-3">
                <label for="old_password" class="form-label">Old Passsword:</label>
                <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" placeholder="Enter old password" name="old_password" value="">
                @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password:</label>
                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="Enter new password" name="new_password" value="">
                @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Enter password" name="confirm_password" value="">
                @error('confirm_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('home')}}" class="btn btn-danger">Back to List</a>
        </form>
    </div>
</div>
@endsection
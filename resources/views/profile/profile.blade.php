@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('update.profile',['user'=>$profile->id])}}" method="post">
            <input type="hidden" name="password" value="{{$profile->password}}"/>
            @csrf
            <div class="mb-3 mt-3">
                <label for="fullname" class="form-label">Name:</label>
                <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" placeholder="Enter name" name="fullname" value="{{$profile->fullname}}">
                @error('fullname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" name="email" value="{{$profile->email}}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter phone" name="phone" value="{{$profile->phone}}">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio1" name="gender" value="Male" {{$profile->gender == 'Male' ? 'checked' : ''}}>Male
                    <label class="form-check-label" for="radio1"></label>
                    </div>
                    <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio2" name="gender" value="Female" {{$profile->gender == 'Female' ? 'checked' : ''}}>Female
                    <label class="form-check-label" for="radio2"></label>
                    </div>
                    <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio2" name="gender" value="Others" {{$profile->gender == 'Others' ? 'checked' : ''}}>Others
                    <label class="form-check-label"></label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('teachers.index')}}" class="btn btn-danger">Back to List</a>
        </form>
    </div>
</div>
@endsection
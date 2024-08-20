@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('teachers.store')}}" method="post">
            <input type="hidden" name="password" value="{{ Hash::make('Admin@123') }}"/>
            @csrf
            <div class="mb-3 mt-3">
                <label for="fullname" class="form-label">Name:</label>
                <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" placeholder="Enter name" name="fullname">
                @error('fullname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" name="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter phone" name="phone">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="department_id" class="form-label requied">Department:</label>
                <select class="form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id">
                    <option value="">Select Department</option>
                    @foreach ($departmentList as $department)
                        <option value="{{$department->id}}">{{$department->department_name}}</option>
                    @endforeach
                </select>
                @error('department_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="subject_id" class="form-label requied">Subjects:</label>
                <select class="form-control @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id">
                    <option value="">Select Subject</option>
                    @foreach ($subjectList as $subject)
                        <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                    @endforeach
                </select>
                @error('subject_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio1" name="gender" value="Male" checked>Male
                    <label class="form-check-label" for="radio1"></label>
                    </div>
                    <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio2" name="gender" value="Female">Female
                    <label class="form-check-label" for="radio2"></label>
                    </div>
                    <div class="form-check">
                    <input type="radio" class="form-check-input" id="radio2" name="gender" value="Others">Others
                    <label class="form-check-label"></label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('students.index')}}" class="btn btn-danger">Back to List</a>
        </form>
    </div>
</div>
@endsection
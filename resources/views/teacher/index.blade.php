@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form>
            <div class="col-md-4">
                <label>Search</label>
                <input type="" name="" id="" class="form-control">
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Department Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teachersList as $value)
                    <tr>
                        <td>{{$value->teachers->fullname}}</td>
                        <td>{{$value->departments->department_name}}</td>
                        <td>{{$value->teachers->email}}</td>
                        <td>{{$value->teachers->phone}}</td>
                        <td>{{$value->teachers->gender}}</td>
                        <td class="text-center"><a href="{{route('teachers.edit',['teacher'=>$value->id])}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                        <td class="text-center"><a href="{{route('teachers.destroy',['teacher'=>$value->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No Record Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
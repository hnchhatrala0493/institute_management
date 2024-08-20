@extends('layouts.app')
<!-- Content Wrapper -->
@section('content')
<div class="row">
    @if(in_array(Auth::user()->role,['teacher','admin']))
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Students</div>
                        @if($totalStudent >= 0)
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalStudent ? $totalStudent : 0 }}</div>
                        @endif
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif(in_array(Auth::user()->role,['admin']))
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Teachers</div>
                        @if($totalTeacher >= 0)
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalTeacher ? $totalTeacher : 0 }}</div>
                        @endif
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Clubs
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Books</div>
                        @if($totalBooks >= 0)
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalBooks ? $totalBooks : 0 }}</div>
                        @endif
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(in_array(Auth::user()->role,['admin']))
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Teacher List</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Department Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No Record Found</td>
                    </tr>
                    @endforelse
                </tbody>
        </table>
        <div class="text-right">
            <a href="{{route('teachers.index')}}" class="btn btn-link">View All</a>
        </div>
    </div>
</div>
@elseif(in_array(Auth::user()->role,['teacher','admin']))
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Student List</h6>
    </div>    
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Department Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($studentList as $value)
                <tr>
                    <td>{{$value->users->fullname}}</td>
                    <td>{{$value->departments->department_name}}</td>
                    <td>{{$value->users->email}}</td>
                    <td>{{$value->users->phone}}</td>
                    <td>{{$value->users->gender}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No Record Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="text-right">
            <a href="{{route('students.index')}}" class="btn btn-link">View All</a>
        </div>
    </div>
</div>
@endif
<!-- End of Content Wrapper -->
@endsection

    
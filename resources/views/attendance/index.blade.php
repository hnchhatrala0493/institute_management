@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Attendance - {{date('M-Y')}}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="accordion accordion-flush accordionFlushExample" id="accordionFlushExample">
                @for($i=date('1');$i<=date('t-Y');$i++)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{$i}}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$i}}" aria-expanded="false" aria-controls="flush-collapse{{$i}}">
                            {{ $i }}
                        </button>
                    </h2>
                    <div id="flush-collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$i}}" data-bs-parent=".accordionFlushExample_{{$i}}">
                    <div class="accordion-body">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($i == date('d'))
                                <a href="{{route('attendance.show',['attendance'=> date('d',strtotime($i))])}}" class="btn btn-primary">View Detail</a>
                                    @forelse ($attendances as $attendance)
                                    <tr>
                                        <td>{{ date('d-m-Y',strtotime($attendance->created_at))}}</td>
                                        <td>{{ $attendance->present_date ? \App\Models\Student::with('users')->find($attendance->student_id)->users->fullname : '-'}}</td>
                                        <td>{{ $attendance->absent_date ? \App\Models\Student::with('users')->find($attendance->student_id)->users->fullname : '-'}}</td>
                                        <td><a href="{{route('attendance.show',['attendance'=>$attendance->id])}}" class="btn btn-link">View</a></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>
                                            No Record Found
                                        </td>
                                    </tr>
                                    @endforelse
                                @else
                                <tr>
                                    <td colspan="4" class="text-center">No Record Available</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection
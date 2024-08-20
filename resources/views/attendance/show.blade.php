@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Attendance - {{date('M-Y')}}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Present</th>
                        <th>Absent</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ date('d-m-Y',strtotime($attendances->created_at))}}</td>
                        <td>{{ $attendances->present_date ? \App\Models\Student::with('users')->find($attendances->student_id)->users->fullname : '-'}}</td>
                        <td>{{ $attendances->absent_date ? \App\Models\Student::with('users')->find($attendances->student_id)->users->fullname : '-'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
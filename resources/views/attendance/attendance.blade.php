@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Present</th>
                        <th>Absent</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{route('attendance.store')}}" method="post">
                            @csrf
                            @forelse($students as $student)
                            <tr>
                                <td>{{ $student->users->fullname }}</td>
                                <td><input type="checkbox" class="" name="attendance[{{ $student->id }}]}" value="present" {{ $student->present_date ? 'checked' : '' }}></td>
                                <td><input type="checkbox" class="" name="attendance[{{ $student->id }}]}" value="absent" {{ $student->absent_date ? 'checked' : '' }}></td>
                            </tr>
                            @empty
                            <tr>
                                <td>No Record Found</td>
                            </tr>
                            @endforelse
                            <div class="text-right mb-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                    </form>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
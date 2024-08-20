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
                    @forelse ($studentList as $value)
                    <tr>
                        <td>{{$value->users->fullname}}</td>
                        <td>{{$value->departments->department_name}}</td>
                        <td>{{$value->users->email}}</td>
                        <td>{{$value->users->phone}}</td>
                        <td>{{$value->users->gender}}</td>
                        <td class="text-center"><a href="{{route('students.edit',['student'=>$value->id])}}" class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                        <td class="text-center">
                                <button class="btn btn-danger me-3" onclick="DeleteRecord('{{$value->id}}')"><i class="fa fa-trash"></i></button>
                        </td>
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

@section('script')
<script>
function DeleteRecord(id) {
    if (confirm("Are you sure you want delete this record?")) {
        var url = "{{ route('students.destroy', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            dataType: "JSON",
            success: function(result) {
                if (result.status == 200) {
                    location.href = "{{route('students.index')}}";
                }
            }
        });
    }
}
</script>
@endsection
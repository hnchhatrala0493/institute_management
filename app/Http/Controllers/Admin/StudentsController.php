<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function index() {
        $title = 'Manage Student';
        $addbtn = 'Add Student';
        $addRoute = route( 'students.create' );
        $studentList = Student::with( 'users' )->with( 'departments' )->orderBy( 'created_at', 'desc' )->paginate( 10 );
        return view( 'students.index', compact( 'title', 'studentList', 'addbtn', 'addRoute' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        $title = 'Add Student';
        $departmentList = Department::orderBy( 'created_at', 'desc' )->get();
        return view( 'students.create', compact( 'title', 'departmentList' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $this->validate( $request, [
            'fullname'=>[ 'required', 'string', 'max:255' ],
            'email'=>[ 'required', 'email', 'unique:users,email' ],
            'phone'=>[ 'required', 'string' ],
            'department_id'=>[ 'required' ],
        ], [
            'fullname.required'=>'Name is required',
            'email.required'=>'Email is required',
            'phone.required'=>'Phone is require',
            'department_id.required'=>'Please select department'
        ] );
        $userArray = [
            'fullname'=> $request->input( 'fullname' ),
            'email'=> $request->input( 'email' ),
            'phone'=> $request->input( 'phone' ),
            'gender'=>$request->input( 'gender' ),
            'role' => 'student',
            'password'=> Hash::make( 'Admin@123' )
        ];
        $user = User::create( $userArray );
        $studentArray = [
            'department_id'=>$request->department_id,
            'user_id'=>$user->id,
        ];
        $student = Student::create( $studentArray );
        if ( $student ) {
            return redirect()->route( 'students.index' );
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        $student = Student::with( 'users' )->find( $id );
        $title = 'View student of '.$student->users->fullname;
        return view( 'students.show', compact( 'title', 'student' ) );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        $student = Student::with( 'users' )->find( $id );
        $title = 'Edit student of '.$student->users->fullname;
        $departmentList = Department::orderBy( 'created_at', 'desc' )->pluck( 'department_name', 'id' )->toArray();
        return view( 'students.edit', compact( 'title', 'student', 'departmentList' ) );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        $student = Student::with( 'users' )->find( $id );
        $this->validate( $request, [
            'fullname'=>[ 'required', 'string', 'max:255' ],
            'email'=>[ 'required', 'email', 'unique:users,email,'.$student->users->id ],
            'phone'=>[ 'required', 'string', 'unique:users,phone,'.$student->users->id ],
            'department_id'=>[ 'required' ],
        ], [
            'fullname.required'=>'Name is required',
            'email.required'=>'Email is required',
            'phone.required'=>'Phone is require',
            'department_id.required'=>'Please select department'
        ] );
        $userArray = [
            'fullname'=> $request->input( 'fullname' ),
            'email'=> $request->input( 'email' ),
            'phone'=> $request->input( 'phone' ),
            'gender'=>$request->input( 'gender' ),
            'role' => 'student',
            'password'=> $request->input( 'password' )
        ];
        $studentArray = [
            'department_id'=>$request->department_id,
            'user_id'=>$student->users->id,
        ];
        $updateDetails = Student::where( 'id', $id )->update( $studentArray );
        $userDetail = User::where( 'id', $student->users->id )->update( $userArray );
        if ( $userDetail || $updateDetails ) {
            return redirect()->route( 'students.index' );
        } else {
            return redirect()->route( 'students.edit', [ 'student'=> $student->id ] );
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        $student = Student::where( 'id', $id )->delete();
        if ( $student ) {
            return redirect()->route( 'students.index' );
        }
    }
}

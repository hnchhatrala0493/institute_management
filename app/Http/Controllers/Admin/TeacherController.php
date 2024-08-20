<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller {
    public function __construct() {
        $this->middleware( 'auth' );
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $title = 'Manage Teacher';
        $addbtn = 'Add Teacher';
        $addRoute = route( 'teachers.create' );
        $teachersList = Teacher::with( 'teachers' )->with( 'departments' )->with( 'subjects' )->orderBy( 'created_at', 'desc' )->paginate( 10 );
        return view( 'teacher.index', compact( 'title', 'teachersList', 'addbtn', 'addRoute' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        $title = 'Add Teacher';
        $departmentList = Department::orderBy( 'created_at', 'desc' )->get();
        $subjectList = Subject::orderBy( 'created_at', 'desc' )->get();
        return view( 'teacher.create', compact( 'title', 'departmentList', 'subjectList' ) );
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
            'subject_id'=>[ 'required' ],
        ], [
            'fullname.required'=>'Name is required',
            'email.required'=>'Email is required',
            'phone.required'=>'Phone is require',
            'department_id.required'=>'Please select department',
            'subject_id.required'=>'Please select department'
        ] );
        $userArray = [
            'fullname'=> $request->input( 'fullname' ),
            'email'=> $request->input( 'email' ),
            'phone'=> $request->input( 'phone' ),
            'gender'=>$request->input( 'gender' ),
            'role' => 'teacher',
            'password'=> Hash::make( 'Admin@123' )
        ];
        $user = User::create( $userArray );
        $teachersArray = [
            'department_id'=>$request->department_id,
            'subject_id'=>$request->subject_id,
            'user_id'=>$user->id,
            'created_id'=>Auth::user()->id
        ];
        $teachers = Teacher::create( $teachersArray );
        if ( $teachers ) {
            return redirect()->route( 'teachers.index' );
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        $student = Teacher::with( 'teachers' )->find( $id );
        $title = 'View Teacher of '.$student->teachers->fullname;
        return view( 'teacher.show', compact( 'title', 'student' ) );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        $teacher = Teacher::with( 'teachers' )->find( $id );
        $title = 'Edit Teacher of '.$teacher->teachers->fullname;
        $departmentList = Department::orderBy( 'created_at', 'desc' )->get();
        $subjectList = Subject::orderBy( 'created_at', 'desc' )->get();
        return view( 'teacher.edit', compact( 'title', 'teacher', 'departmentList', 'subjectList' ) );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        //
    }
}

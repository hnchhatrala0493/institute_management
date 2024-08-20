<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $title = 'Manage Student Attendance';
        $student = Student::all();
        $attendances = Attendance::all();
        $addbtn = 'Attendance';
        $addRoute = route( 'attendance.create' );
        return view( 'attendance.index', compact( 'title', 'student', 'addbtn', 'addRoute', 'attendances' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        $title = 'Today Student Attendance';
        $students = Student::all();
        return view( 'attendance.attendance', compact( 'title', 'students' ) );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        foreach ( $request->attendance as $id => $status ) {
            $attendance = new Attendance();
            $attendance->student_id = $id;
            $attendance->teacher_id = Teacher::select( 'id' )->where( 'user_id', Auth::user()->id )->first()->id;
            $attendance->present_date = $status === 'present' ? date( 'Y-m-d', strtotime( 'now' ) ) : NULL;
            $attendance->absent_date = $status === 'absent' ? date( 'Y-m-d', strtotime( 'now' ) ) : NULL;
            $attendance->save();
        }
        if ( $attendance ) {
            return redirect()->route( 'attendance.index' );
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        $title = 'Show Attendance Details';
        $attendances = Attendance::where( 'id', $id )->first();
        return view( 'attendance.show', compact( 'title', 'attendances' ) );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        //
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

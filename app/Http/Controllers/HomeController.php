<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct() {
        $this->middleware( 'auth' );
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */

    public function index() {
        $title = 'Dashboard';
        $totalStudent = Student::count();
        $totalTeacher = Teacher::count();
        $totalBooks = Book::count();
        $studentList = Student::all();
        $teachersList = Teacher::all();
        return view( 'dashboard.dashboard', compact( 'title', 'totalStudent', 'totalTeacher', 'totalBooks', 'studentList', 'teachersList' ) );
    }
}

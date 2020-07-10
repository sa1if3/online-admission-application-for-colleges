<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Student;
use App\Course;
use App\AdmisssionApplication;
use App\Religion;
use App\Category;
use App\Board;
use App\Gender;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{

    protected $redirectTo = '/student/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('student.auth:student');
    }

    /**
     * Show the Student dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $userStep=Auth::guard('student')->user()->where_am_i;
        $userId=Auth::guard('student')->user()->id;
        if($userStep == 99){
            $mobile=Auth::guard('student')->user()->mobile;
            return view('student.sendOTP',compact('mobile'));
        }
        if($userStep == 98){
            $mobile=Auth::guard('student')->user()->mobile;
            return view('student.verifyOTP',compact('mobile'));
        }
        elseif($userStep == 0){
            $courses=Course::all();
            return view('student.selectCourse',compact('courses'));
        }
        elseif($userStep == 1){
            $student_courses=AdmisssionApplication::where("student_id","=",$userId)->get();
            foreach($student_courses AS $student_course)
            {
                $student_course_id=$student_course->course_record_id;
                break;
            }
            $course=Course::find($student_course_id);
            return view('student.home',compact('course'));
        }
        elseif($userStep == 2){
            $student_courses=AdmisssionApplication::where("student_id","=",$userId)->get();
            foreach($student_courses AS $student_course)
            {
                $student_course_id=$student_course->course_record_id;
                break;
            }
            $genders=Gender::all();
            $categories=Category::all();
            $religions=Religion::all();
            return view('student.personal',compact('genders','categories','religions','student_course'));
        }
        elseif($userStep == 3){
            $student_courses=AdmisssionApplication::where("student_id","=",$userId)->get();
            foreach($student_courses AS $student_course)
            {
                $student_course_id=$student_course->course_record_id;
                break;
            }
            $boards=Board::all();
            return view('student.professional',compact('boards','student_course'));
        }
        elseif($userStep == 4){
            $student_courses=AdmisssionApplication::where("student_id","=",$userId)->get();
            foreach($student_courses AS $student_course)
            {
                $student_course_id=$student_course->course_record_id;
                break;
            }            
            return view('student.upload',compact('student_course'));
        }
        if($userStep == 5){
            $student_courses=AdmisssionApplication::where("student_id","=",$userId)->get();
            foreach($student_courses AS $student_course)
            {
                $student_course_id=$student_course->course_record_id;
                break;
            }
            $course=Course::find($student_course_id);            
            return view('student.confirm',compact('student_course','course'));
        }
        else{
            $student_courses=AdmisssionApplication::where("student_id","=",$userId)->get();
            foreach($student_courses AS $student_course)
            {
                $student_course_id=$student_course->course_record_id;
                break;
            }
            $course=Course::find($student_course_id);          
            return view('student.submit',compact('student_course','course'));
        }
    }
}
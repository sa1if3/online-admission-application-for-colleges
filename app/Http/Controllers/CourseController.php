<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        $courses = Course::all();
        return view('courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        $validator = \Validator::make($request->all(), [
            'name'=>'required',
            'compulsory'=>'required',
            'elective'=>'nullable',
            'major'=>'nullable',
            'instruction'=>'nullable',
            'course_prefix'=>'required',
            'course_semester'=>'required|min:1',
        ]);

        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/courses')
                        ->withErrors($validator)
                        ->withInput();
        }
        $course = new Course([
            'name' => $request->get('name'),
            'compulsory' => $request->get('compulsory'),
            'elective' => $request->get('elective'),
            'major' => $request->get('major'),
            'description'=> $request->get('instruction'),
            'course_prefix' => $request->get('course_prefix'),
            'course_semester'=> $request->get('course_semester')
        ]);
        $course->save();
        Log::info(__CLASS__."::".__FUNCTION__." Saved");
        return redirect('/courses')->with('success', 'Course saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        $course = Course::find($id);
        return view('courses.edit', compact('course')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        $validator = \Validator::make($request->all(), [
            'name'=>'required',
            'id'=>'required',
            'active-stat'=>'required',
            'compulsory'=>'required',
            'elective'=>'nullable',
            'major'=>'nullable',
            'instruction'=>'nullable',
            'course_semester'=>'required',
        ]);

        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/courses')
                        ->withErrors($validator)
                        ->withInput();
        }
        $course = Course::find($id);
        $course->name =  $request->get('name');
        $course->active =  $request->get('active-stat');
        $course->compulsory =  $request->get('compulsory');
        $course->elective =  $request->get('elective');
        $course->major =  $request->get('major');
        $course->description =  $request->get('instruction');
        $course->course_semester =  $request->get('course_semester');
        $course->save();
        Log::info(__CLASS__."::".__FUNCTION__." $id Updated");
        return redirect('/courses')->with('success', 'Course updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        Log::debug("Delete course $id");
        $course = Course::find($id);
        $course->delete();
        Log::info(__CLASS__."::".__FUNCTION__." $id course Deleted");
        return redirect('/courses')->with('success', 'Course deleted!');
    }
}

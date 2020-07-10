<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Feedback;
use Log;
use DB;
class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::debug(__CLASS__."::".__FUNCTION__);
        $feedbacks=DB::table('feedback_record')
                    ->select('feedback_record.*','course_record.name as course_record_name')
                    ->leftJoin('course_record','feedback_record.course_record_id','=','course_record.id')
                    ->get();
        return view('feedbacks.index',compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::debug(__CLASS__."::".__FUNCTION__);
        $courses=Course::all();
        return view('feedbacks.create',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::debug(__CLASS__."::".__FUNCTION__);
        $validator = \Validator::make($request->all(), [
            'course'=>'required',
            'name'=>'required|max:255|regex:/^[A-Za-z\s]+$/',
            'email'=>'required|email|max:255',
            'department'=>'nullable|max:255|regex:/^[A-Za-z\s]+$/',
            'feedback_message'=>'required|min:100|max:500|regex:/^[A-Za-z.,?!\s]+$/',

        ]);
        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/feedback/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            $decrypted_course = decrypt($request->input('course'));

            if(!Course::find($decrypted_course)){
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            $validator=array("Course Not Found");
            return redirect('/feedback/create')
                        ->withErrors($validator)
                        ->withInput();                
            }
            
                DB::transaction(function () use ($request,$decrypted_course) {
                    /*Transaction Start*/
                    $Feedback = new Feedback([
                        'course_record_id' => $decrypted_course,
                        'email' => $request->input('email'),
                        'name' => $request->input('name'),
                        'feedback_message' => $request->input('feedback_message'),
                        'department' => $request->input('department')
                    ]);
                    $Feedback->save();


                });/*Transaction End*/
            Log::info(__CLASS__."::".__FUNCTION__." Thank You! Your feedback has been received.");
            return redirect('/feedback/create')->with('success','Thank You! Your feedback has been received.'); 

        } catch (DecryptException $e) {
            Log::error(__CLASS__."::".__FUNCTION__." Decryption Failed");
            $exception_error=array("Unverified Method");
            return redirect('/feedback/create')
                        ->withErrors($exception_error)
                        ->withInput();
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

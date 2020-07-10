<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Fees_Body;
use App\Course;
use App\Category;
use App\Gender;
use DB;
class FeesHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        $validator = \Validator::make($request->all(), [
            'course_id'=>'required',
        ]);

        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/courses')
                        ->withErrors($validator)
                        ->withInput();
        }

        $course = Course::find($request->get('course_id'));
        $categorys = category::all();
        $genders = Gender::all();
        return view('feesheads.create', compact('course','categorys','genders')); 
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
            'fee' => ['required','regex:/^\d*(\.\d{1,2})?$/'],
            'category_id' =>'required',
            'gender_id' =>'required',
            'course_record_id'=>'required',
            'BPLWaiver' =>'required',
            'PWDWaiver' =>'required',
        ]);
        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/courses')
                        ->withErrors($validator)
                        ->withInput();
        }

        $course = new Fees_Body([
            'name' => $request->get('name'),
            'fee' => $request->get('fee'),
            'category_record_id' => $request->get('category_id'),
            'course_record_id'=> $request->get('course_record_id'),
            'gender_record_id'=> $request->get('gender_id'),
            'checkBPL'=> $request->get('BPLWaiver'),
            'checkPWD'=> $request->get('PWDWaiver'),
        ]);
        $course->save();
        Log::info(__CLASS__."::".__FUNCTION__." Saved");
        return redirect('/feesheads/'.$request->get('course_record_id'))->with('success', 'Fee saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        $course = Course::find($id);
        $categorys = category::all();
        $genders = Gender::all();
/*        $feebodys = Fees_Body::where('course_record_id','=',$id)->get();*/
        $feebodys = DB::table('fee_body_record')
                    ->select('fee_body_record.*',DB::raw('gender_record.name AS gender_record_name'),DB::raw('category_record.name AS category_record_name'))
                    ->leftJoin('gender_record','gender_record.id','=','fee_body_record.gender_record_id')
                    ->leftJoin('category_record','category_record.id','=','fee_body_record.category_record_id')
                    ->where('course_record_id','=',$id)
                    ->get();
        return view('feesheads.show',compact('feebodys','course','categorys','genders'));
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
        $categorys = category::all();
        $genders = Gender::all();
        $feebody = Fees_Body::find($id);
        $course = Course::find($feebody->course_record_id);
        return view('feesheads.edit', compact('feebody','genders','categorys','course')); 
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
            'id'=>'required',
            'active-stat'=>'required',
            'name'=>'required',
            'fee' => ['required','regex:/^\d*(\.\d{1,2})?$/'],
            'category_id' =>'required',
            'gender_id' =>'required',
            'BPLWaiver' =>'required',
            'PWDWaiver' =>'required',
        ]);

        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/feesheads')
                        ->withErrors($validator)
                        ->withInput();
        }
        $feebody = Fees_Body::find($id);
        $feebody->name =  $request->get('name');
        $feebody->active =  $request->get('active-stat');
        $feebody->fee =  $request->get('fee');
        $feebody->category_record_id =  $request->get('category_id');
        $feebody->gender_record_id =  $request->get('gender_id');
        $feebody->checkBPL =  $request->get('BPLWaiver');
        $feebody->checkPWD =  $request->get('PWDWaiver');
        $feebody->save();
        Log::info(__CLASS__."::".__FUNCTION__." $id Updated");
        return redirect('/feesheads/'.$feebody->course_record_id)->with('success', 'Fees Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        Log::debug("Delete Fee_Body $id");
        $Fee_Body = Fees_Body::find($id);
        $FeeCourseId = $Fee_Body->course_record_id;
        $Fee_Body->delete();
        Log::info(__CLASS__."::".__FUNCTION__." $id Fee_Body Deleted");
        return redirect('/feesheads/'.$FeeCourseId)->with('success', 'Fees deleted!');
    }
}

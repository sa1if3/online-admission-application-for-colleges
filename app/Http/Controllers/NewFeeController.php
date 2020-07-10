<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use DB;
use App\Course;
use App\NewFee;
class NewFeeController extends Controller
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
        $newfees = NewFee::where('course_record_id','=',$request->get('course_id'))->orderBy('fee_year', 'asc')->get();
        return view('newfees.create', compact('course','newfees')); 
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
            'fee_name'=>'required',
            'fee_year'=>'required',
            'Gen'=>'required|integer|min:0',
            'SC'=>'nullable|integer|min:0',
            'ST'=>'nullable|integer|min:0',
            'OBC'=>'nullable|integer|min:0',
            'PWD'=>'nullable|integer|min:0',
            'BPL'=>'nullable|integer|min:0',
            'course_record_id'=>'required',
        ]);

        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        if($request->get('fee_year')=='0'){
            $count=NewFee::where('course_record_id','=',$request->get('course_record_id'))
                   ->where('fee_year','=','0')->count();
            if($count){
            Log::error(__CLASS__."::".__FUNCTION__." Admission Entry Exists");
            $error_msg=array('Admission Entry Already Exist. Please edit that Entry!');
            return redirect()->back()
                        ->withErrors($error_msg)
                        ->withInput();                
            }
            $NewFee = new NewFee([
                'fee_name' => $request->get('fee_name'),
                'fee_year' => $request->get('fee_year'),
                'gen' => $request->get('Gen'),
                'sc' => $request->get('SC'),
                'st' => $request->get('ST'),
                'obc' => $request->get('OBC'),
                'pwd' => $request->get('PWD'),
                'bpl' => $request->get('BPL'),
                'course_record_id' => $request->get('course_record_id')
            ]);
            $NewFee->save();
        }else{
            $NewFee = new NewFee([
                'fee_name' => $request->get('fee_name'),
                'fee_year' => $request->get('fee_year'),
                'gen' => $request->get('Gen'),
                'sc' => $request->get('Gen'),
                'st' => $request->get('Gen'),
                'obc' => $request->get('Gen'),
                'pwd' => $request->get('Gen'),
                'bpl' => $request->get('Gen'),
                'course_record_id' => $request->get('course_record_id')
            ]);
            $NewFee->save();            
        }
        
        Log::info(__CLASS__."::".__FUNCTION__." Saved");
        return redirect()->back()->with('success', 'New Fee Save saved!');
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
        $newfee = NewFee::find($id);
        $course = Course::find($newfee->course_record_id);
        return view('newfees.edit', compact('newfee','course')); 
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
            'fee_name'=>'required',
            'Gen'=>'required|integer|min:0',
            'SC'=>'nullable|integer|min:0',
            'ST'=>'nullable|integer|min:0',
            'OBC'=>'nullable|integer|min:0',
            'PWD'=>'nullable|integer|min:0',
            'BPL'=>'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/courses')
                        ->withErrors($validator)
                        ->withInput();
        }
        $NewFee = NewFee::find($id);
            if($NewFee->fee_year == '0'){
                $NewFee->fee_name =  $request->get('fee_name');
                $NewFee->gen =  $request->get('Gen');
                $NewFee->sc =  $request->get('SC');
                $NewFee->st =  $request->get('ST');
                $NewFee->obc =  $request->get('OBC');
                $NewFee->pwd =  $request->get('PWD');
                $NewFee->bpl =  $request->get('BPL');
            }else{
                $NewFee->fee_name =  $request->get('fee_name');
                $NewFee->gen =  $request->get('Gen');
                $NewFee->sc =  $request->get('Gen');
                $NewFee->st =  $request->get('Gen');
                $NewFee->obc =  $request->get('Gen');
                $NewFee->pwd =  $request->get('Gen');
                $NewFee->bpl =  $request->get('Gen');
            }

        $NewFee->save();
        Log::info(__CLASS__."::".__FUNCTION__." $id Updated");
        return redirect('/courses')->with('success', 'Fee Record updated!');
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
        Log::debug("Delete NewFee $id");
        $NewFee = NewFee::find($id);
        $NewFee->delete();
        Log::info(__CLASS__."::".__FUNCTION__." $id NewFee Deleted");
        return redirect()->back()->with('success', 'Fee Record deleted!');
    }
}

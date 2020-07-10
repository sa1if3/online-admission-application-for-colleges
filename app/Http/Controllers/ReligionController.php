<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Religion;

class religionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        $religions = Religion::all();
        return view('religions.index',compact('religions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        return view('religions.create');
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
        ]);

        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/religions')
                        ->withErrors($validator)
                        ->withInput();
        }
        $religion = new Religion([
            'name' => $request->get('name')
        ]);
        $religion->save();
        Log::info(__CLASS__."::".__FUNCTION__." Saved");
        return redirect('/religions')->with('success', 'religion saved!');
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
        $religion = Religion::find($id);
        return view('religions.edit', compact('religion')); 
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
        ]);

        if ($validator->fails()) {
            Log::error(__CLASS__."::".__FUNCTION__." Validation Failed");
            return redirect('/religions')
                        ->withErrors($validator)
                        ->withInput();
        }
        $religion = Religion::find($id);
        $religion->name =  $request->get('name');
        $religion->save();
        Log::info(__CLASS__."::".__FUNCTION__." $id Updated");
        return redirect('/religions')->with('success', 'religion updated!');
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
        Log::debug("Delete religion $id");
        $religion = Religion::find($id);
        $religion->delete();
        Log::info(__CLASS__."::".__FUNCTION__." $id religion Deleted");
        return redirect('/religions')->with('success', 'religion deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Board;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        $boards = Board::all();
        return view('boards.index',compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::debug(__CLASS__."::".__FUNCTION__." Called by ".auth('admin')->user()->id);
        return view('boards.create');
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
            return redirect('/boards')
                        ->withErrors($validator)
                        ->withInput();
        }
        $board = new Board([
            'name' => $request->get('name')
        ]);
        $board->save();
        Log::info(__CLASS__."::".__FUNCTION__." Saved");
        return redirect('/boards')->with('success', 'Board saved!');
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
        $board = Board::find($id);
        return view('boards.edit', compact('board')); 
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
            return redirect('/boards')
                        ->withErrors($validator)
                        ->withInput();
        }
        $board = Board::find($id);
        $board->name =  $request->get('name');
        $board->save();
        Log::info(__CLASS__."::".__FUNCTION__." $id Updated");
        return redirect('/boards')->with('success', 'board updated!');
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
        Log::debug("Delete board $id");
        $board = Board::find($id);
        $board->delete();
        Log::info(__CLASS__."::".__FUNCTION__." $id board Deleted");
        return redirect('/boards')->with('success', 'board deleted!');
    }
}

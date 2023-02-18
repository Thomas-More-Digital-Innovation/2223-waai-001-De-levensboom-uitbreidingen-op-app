<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;

class TeenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teens = Info::all();
        return view('teens.index', compact('teens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Info::create($request->all());

        $msg = "New Teen Info Content Created successful! ";
        return redirect('teens')->with('msg', $msg);
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
        $teen = Info::find($id);
        return view('teens.edit', compact('teen'));
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
        $teen = Info::find($id);
        $teen->update($request->all());

        $msg = "Teen Info Content Updated successful! ";
        return redirect('teens')->with('msg', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teen = Info::find($id);
        $teen->delete();

        $msg = "Teen Info Content Deleted successful! ";
        return redirect('teens')->with('msg', $msg);
    }
}

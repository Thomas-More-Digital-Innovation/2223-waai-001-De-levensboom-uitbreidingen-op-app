<?php

namespace App\Http\Controllers;

use App\Models\InfoContent;
use Illuminate\Http\Request;

class TeenInfoContentController extends Controller
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
    public function create()
    {
        return view('teens.infoContents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['info_id' => 9]);
        InfoContent::create($request->all());

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
        $infoContent = InfoContent::find($id);
        $infoContent->content = InfoContent::where('info_id', $id)->first()->content;
        return view('teens.infoContents.edit', compact('infoContent'));
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
        InfoContent::updateOrCreate(
            ['info_id' => $id],
            ['title' => $request->title
            ,'content' => $request->content],
        );

        $msg = "Adult Info Content Updated successful! ";
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
        $teenInfoContent = InfoContent::find($id);
        $teenInfoContent->delete();

        $msg = "Adult Info Content Deleted successful! ";
        return redirect('adults')->with('msg', $msg);
    }
}

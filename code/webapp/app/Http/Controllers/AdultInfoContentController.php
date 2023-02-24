<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\InfoContent;
use Illuminate\Http\Request;

class AdultInfoContentController extends Controller
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
        $info_id = $request->info_id;
        return view('adults.infoContents.create', compact('info_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->request->add(['info_id' => $request->info_id]);
        InfoContent::create($request->all());

        $msg = "New Adult Info Content Created successful! ";
        return redirect('adults')->with('msg', $msg);
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

        return view('adults.infoContents.edit', compact('infoContent'));
    
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
        $adultInfoContent = InfoContent::find($id);
        $adultInfoContent->update($request->all());
        $info_id = $adultInfoContent->info_id;

        $msg = "Adult Info Content Updated successful! ";
        return redirect('adults/'.$info_id.'/edit')->with('msg', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adultInfoContent = InfoContent::find($id);
        $adultInfoContent->delete();
        $info_id = $adultInfoContent->info_id;

        $msg = "Adult Info Content Deleted successful! ";
        return redirect('adults/'.$info_id.'/edit')->with('msg', $msg);
    }
}

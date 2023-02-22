<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adults = Info::where('section_id', 1)->get();
        return view('adults.index', compact('adults'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('allowAdmin');

        return view('adults.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('allowAdmin');

        $request->request->add(['section_id' => 1]);
        Info::create($request->all());

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
        $adult = Info::find($id);
        return view('adults.edit', compact('adult'));
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
        $adult = Info::find($id);
        $adult->update($request->all());

        $msg = "Adult Info Content Updated successful! ";
        return redirect('adults')->with('msg', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('allowAdmin');
        
        $adult = Info::find($id);
        $adult->delete();

        $msg = "Adult Info Content Deleted successful! ";
        return redirect('adults')->with('msg', $msg);
    }
}

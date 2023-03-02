<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\InfoContent;
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
        Gate::authorize('notClient');
        
        $adults = Info::where('section_id', 1)->get()->sortBy('orderNumber');
        $infoContents = InfoContent::all();
        return view('adults.index', compact('adults','infoContents'));
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

        $highestOrderNumber = Info::where('section_id', 1)->max('orderNumber');
        $request->request->add(['orderNumber' => $highestOrderNumber + 1]);

        $request->request->add(['section_id' => 1]);
        Info::create($request->all());

        $msg = "New Adult Info Content Created successful! ";
        return redirect('adults')->with('msg', $msg);
    }

    public function updateOrder(Request $request){
        Gate::authorize('allowAdmin');

        $info = Info::find($request->adult);
        if ($request->order == 'up') {
            $info->update(['orderNumber' => $info->orderNumber - 1]);
        }
        else{
            $info->update(['orderNumber' => $info->orderNumber + 1]);
        }

        $adults = Info::where('section_id', 1)->get()->sortBy('orderNumber');
        $infoContents = InfoContent::all();
        $msg = "Adult order updated successful! ";
        return view('adults.index', compact('adults','infoContents'));
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
        Gate::authorize('allowAdmin');

        $adult = Info::find($id);
        $infoContents = InfoContent::where('info_id', $id)->get();
        return view('adults.edit', compact('adult','infoContents'));
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
        Gate::authorize('allowAdmin');
        
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
        
        InfoContent::where('info_id', $id)->delete();
        $adult = Info::find($id);
        $adult->delete();
        

        $msg = "Adult Info Content Deleted successful! ";
        return redirect('adults')->with('msg', $msg);
    }
}

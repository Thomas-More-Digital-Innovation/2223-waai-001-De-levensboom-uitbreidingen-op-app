<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\InfoContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AdultInfoContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('notClient');
        
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Gate::authorize('allowAdmin');

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

        if ($request->hasFile('titleImage') && $request->file('titleImage')->isValid()) {
            $request->merge(['titleImage' => $request->titleImage->getClientOriginalName()]);
            $request->titleImage->storeAs('public/adults', $request->titleImage->getClientOriginalName());  
        }
        else {
            $request->request->add(['titleImage' => $request->titleImageUrl]);
        }

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
        Gate::authorize('allowAdmin');

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
        Gate::authorize('allowAdmin');

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
        Gate::authorize('allowAdmin');
        
        $adultInfoContent = InfoContent::find($id);
        $adultInfoContent->delete();
        $info_id = $adultInfoContent->info_id;

        $msg = "Adult Info Content Deleted successful! ";
        return redirect('adults/'.$info_id.'/edit')->with('msg', $msg);
    }
}

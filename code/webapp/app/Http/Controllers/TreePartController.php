<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\TreePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TreePartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize("notClient");

        $treeParts = TreePart::all();
        return view("treeParts.index", compact("treeParts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //     
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
        Gate::authorize("allowAdmin");

        $treePart = TreePart::find($id);
        $questions = Question::all();
        
        return view("treeParts.edit", compact("treePart", "questions"));
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
        Gate::authorize("allowAdmin");

        // $new = Info::find($id);
        // $new->update($request->all());

        // InfoContent::updateOrCreate(
        //     ["info_id" => $id],
        //     [
        //         "title" => $request->title,
        //         "content" => $request->content,
        //         "shortContent" => $request->shortContent,
        //     ]
        // );

        // $msg = "New Info Content Updated successful! ";
        // return redirect("news")->with("msg", $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

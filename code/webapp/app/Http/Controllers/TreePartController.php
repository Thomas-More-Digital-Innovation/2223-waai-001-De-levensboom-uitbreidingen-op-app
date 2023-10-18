<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\QuestionList;
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
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Gate::authorize("allowAdmin");

        $tree_part_id = $id;
        $question_list_id = $request->question_list_id;
        $treePart = TreePart::find($tree_part_id);
        $questions = Question::where("tree_part_id", $tree_part_id)
        ->where("question_list_id", $question_list_id)->get();
        $questionList = QuestionList::where("id", $question_list_id)->first();
        
        return view("questionLists.treeParts.edit", compact("treePart", "questions", "questionList"));
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

        $tree_part = TreePart::find($id);
        $updatedTreePart = $tree_part->update($request->all());
        
        $msg = "TreePart Updated successful! ";
        return redirect("/questionLists");
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

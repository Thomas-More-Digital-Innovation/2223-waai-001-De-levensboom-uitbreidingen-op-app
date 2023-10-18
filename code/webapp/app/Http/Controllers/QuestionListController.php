<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\QuestionList;
use App\Models\TreePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuestionListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize("notClient");

        $questionLists = QuestionList::all();
        return view("questionLists.index", compact("questionLists"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Gate::authorize("allowAdmin");
        return view("QuestionLists.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize("allowAdmin");
        QuestionList::create($request->all());

        $msg = "New Question List Created successful! ";
        return redirect("questionLists/")->with(
            "msg",
            $msg
        ); 
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

        $questionList = QuestionList::find($id);
        $treeParts = TreePart::all();
        return view("questionLists.edit", compact("questionList", "treeParts"));
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

        $question = QuestionList::find($id);
        $updatedQuestion = $question->update($request->all());

        $msg = "Question list Updated successful! ";
        return redirect("questionLists/")->with("msg", $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize("allowAdmin");

        $questionList = QuestionList::find($id);
        $questionList->delete();

        $msg = "Question Deleted successful! ";
        return redirect("questionLists/")->with("msg", $msg);
    }
}

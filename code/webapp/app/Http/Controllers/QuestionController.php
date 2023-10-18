<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TreePart;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::authorize("notClient");

        // $questions = Question::all();
        // return view("questions.index", compact("questions"));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Gate::authorize("allowAdmin");

        $tree_part_id = $request->tree_part_id;
        $question_list_id = $request->question_list_id;
        return view("questionLists.treeParts.questions.create", compact("tree_part_id", "question_list_id"));
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

        $request->request->add(["tree_part_id" => $request->tree_part_id]);
        $request->request->add(["question_list_id" => $request->question_list_id]);
        Question::create($request->all());

        
        $msg = "New Question Created successful! ";
        return redirect("treeParts/" . $request->tree_part_id . "/edit?question_list_id=" . $request->question_list_id)->with(
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

        $question = Question::find($id);
        return view("QuestionLists.treeParts.questions.edit", compact("question"));
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

        $question = Question::find($id);
        $updatedQuestion = $question->update($request->all());

        $tree_part_id = $question->tree_part_id;
        $question_list_id = $question->question_list_id;
        $msg = "Question Updated successful! ";
        return redirect("treeParts/" . $tree_part_id . "/edit?question_list_id=" . $question_list_id)->with("msg", $msg);
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
        $question = Question::find($id);
        $tree_part_id = $question->tree_part_id;
        $question_list_id = $question->question_list_id;
        $question->delete();

        $msg = "Question Deleted successful! ";
        return redirect("treeParts/" . $tree_part_id . "/edit?question_list_id=" . $question_list_id)->with("msg", $msg);
    }
}

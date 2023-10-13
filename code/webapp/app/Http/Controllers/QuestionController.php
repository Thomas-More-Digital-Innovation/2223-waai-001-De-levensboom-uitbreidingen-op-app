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
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Gate::authorize("allowAdmin");

        $tree_part_id = $request->id;
        return view("treeParts.questions.create", compact("tree_part_id"));
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
        dd($request);

        return view("treeParts.index", compact("tree_part_id"));  
        // Question::create($request->all());


        // $request->request->add(["section_id" => 3]);
        // Info::create($request->all());

        // $request->request->add(["info_id" => Info::latest()->first()->id]);
        // InfoContent::create($request->all());

        // $msg = "New New Info Content Created successful! ";
        // return redirect("questions")->with("msg", $msg);
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

        // $news = Info::find($id);
        // $news->shortContent = InfoContent::where(
        //     "info_id",
        //     $id
        // )->first()->shortContent;
        // $news->content = InfoContent::where("info_id", $id)->first()->content;
        // return view("questions.edit", compact("news"));
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
        Gate::authorize("allowAdmin");

        // $new = Info::find($id);
        // $new->delete();

        // $msg = "New Info Content Deleted successful! ";
        // return redirect("news")->with("msg", $msg);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserList;
use App\Models\User;
use App\Models\QuestionList;
use App\Models\QuestionUserList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClientLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize("notClient");

        $user = auth()->user();
        $user_lists = UserList::where('mentor_id', $user->id)->get();
        $clients = [];
        foreach ($user_lists as $user_list){
            $clients[] = User::find($user_list->client_id);
        }
        return view('clientLinks.index', compact('clients'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showList($id)
    {
        // Gate::authorize("notClient");

        // $client_id = $id;
        // $question_lists = QuestionList::all();
        // $question_user_list = QuestionUserList::where('user_id', $client_id);

        // return view('clientLinks.edit', compact('question_lists', 'question_user_list', 'client_id'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        Gate::authorize("notClient");

        $client_id = $id;
        $question_lists = QuestionList::all();
        $question_user_lists = QuestionUserList::where('user_id', $client_id)->get();

        return view('clientLinks.edit', compact('question_lists', 'question_user_lists', 'client_id'));
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

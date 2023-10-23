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

        $client_id = $id;
        $question_user_list_id = $request->question_user_list_id;
        $question_list_id = $request->question_list_id;
        QuestionUserList::where('user_id', $client_id)->update(['active' => false]);
        if(!QuestionUserList::where('question_list_id', $question_list_id)->where('user_id', $client_id)->exists()) {
            $new_list = new QuestionUserList();
            $new_list->question_list_id = $question_list_id;
            $new_list->user_id = $client_id;
            $new_list->active = true;
            $new_list->save();

        } else {
            $list_to_change = QuestionUserList::where('question_list_id', $question_list_id)->where('user_id', $client_id)->first();
            $list_to_change->update(['active' => true]);
        }

        $msg = " Question List set to Active! ";

        return redirect('clientLinks/' . $client_id . '/edit')->with("msg", $msg);
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

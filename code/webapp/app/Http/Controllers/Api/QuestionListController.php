<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionListRequest;
use App\Models\QuestionList;
use App\Models\QuestionUserList;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

/**
 * @OA\Schema(
 * schema="QuestionList",
 * @OA\Property(
 * property="id",
 * type="integer",
 * format="int64",
 * example=1
 * ),
 * @OA\Property(
 * property="questionList",
 * type="string",
 * example="QuestionList 1"
 * ),
 * @OA\Property(
 * property="answer",
 * type="string",
 * example="Answer 1"
 * ),
 * @OA\Property(
 * property="created_at",
 * type="string",
 * format="date-time",
 * example="2021-05-01 12:00:00"
 * ),
 * @OA\Property(
 * property="updated_at",
 * type="string",
 * format="date-time",
 * example="2021-05-01 12:00:00"
 * ),
 * )
 * @OA\Get(
 * path="/api/questionLists",
 * tags={"questionLists"},
 * summary="Get list of questionLists",
 * description="Returns list of questionLists",
 * operationId="questionListsIndex",
 * @OA\Parameter(
 * name="Authorization",
 * description="Bearer {token}",
 * in="header",
 * required=true,
 * ),
 * @OA\Response(
 * response=200,
 * description="successful operation",
 * @OA\JsonContent(
 * @OA\Property(
 * property="status",
 * type="boolean",
 * example=true
 * ),
 * @OA\Property(
 * property="questionLists",
 * type="array",
 * @OA\Items(ref="#/components/schemas/QuestionList")
 * )
 * )
 * ),
 * @OA\Response(
 * response=401,
 * description="Unauthorized",
 * )
 * )
 * @OA\Post(
 * path="/api/questionLists",
 * tags={"questionLists"},
 * summary="Create new questionList",
 * description="Create new questionList",
 * operationId="questionListsStore",
 * @OA\Parameter(
 * name="Authorization",
 * description="Bearer {token}",
 * in="header",
 * required=true,
 * ),
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(ref="#/components/schemas/QuestionList")
 * ),
 * @OA\Response(
 * response=200,
 * description="successful operation",
 * @OA\JsonContent(
 * @OA\Property(
 * property="status",
 * type="boolean",
 * example=true
 * ),
 * @OA\Property(
 * property="questionList",
 * ref="#/components/schemas/QuestionList"
 * )
 * )
 * ),
 * @OA\Response(
 * response=401,
 * description="Unauthorized"
 * ),
 * )
 * @OA\Patch(
 * path="/api/questionLists/{id}",
 * tags={"questionLists"},
 * summary="Update QuestionList",
 * description="Update QuestionList",
 * operationId="questionListsUpdate",
 * @OA\Parameter(
 * name="Authorization",
 * description="Bearer {token}",
 * in="header",
 * required=true,
 * ),
 * @OA\Parameter(
 * name="id",
 * description="QuestionList id",
 * in="path",
 * required=true,
 * ),
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(ref="#/components/schemas/QuestionList")
 * ),
 * @OA\Response(
 * response=200,
 * description="successful operation",
 * @OA\JsonContent(
 * @OA\Property(
 * property="status",
 * type="boolean",
 * example=true
 * ),
 * @OA\Property(
 * property="questionList",
 * ref="#/components/schemas/QuestionList"
 * ),
 * ),
 * ),
 * @OA\Response(
 * response=401,
 * description="Unauthorized"
 * ),
 * )
 * @OA\Delete(
 * path="/api/questionLists/{id}",
 * tags={"questionLists"},
 * summary="Delete question",
 * description="Delete question",
 * operationId="questionsDestroy",
 * @OA\Parameter(
 * name="Authorization",
 * description="Bearer {token}",
 * in="header",
 * required=true,
 * ),
 * @OA\Parameter(
 * name="id",
 * description="Question id",
 * in="path",
 * required=true,
 * ),
 * @OA\Response(
 * response=200,
 * description="successful operation",
 * @OA\JsonContent(
 * @OA\Property(
 * property="status",
 * type="boolean",
 * example=true
 * ),
 * @OA\Property(
 * property="question",
 * ref="#/components/schemas/Question"
 * ),
 * ),
 * ),
 * @OA\Response(
 * response=401,
 * description="Unauthorized"
 * ),
 * )
 */

class QuestionListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionLists = QuestionList::all();

        return response()->json([
            "status" => true,
            "questionLists" => [$questionLists],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuestionList  $questionList
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionList $questionList)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activeList(Request $request)
    {
        $id = $request->id;
        // $id = 7;
        $active_lists = QuestionUserList::where('user_id', $id)->where('active', 1)->get()->pluck('question_list_id');
        $questions = Question::whereIn('question_list_id', $active_lists)->get();
        $answers = Answer::whereIn('question_id', $questions->pluck('id'))->get();

        return response()->json([
            "status" => true,
            "question_list_ids" => [$active_lists],
            "questions" => [$questions],
            "answers" => [$answers],
        ]);
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
    public function store(StoreQuestionRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionList  $questionList
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionList $questionList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionList  $questionList
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestionListRequest $request, QuestionList $questionList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionList  $questionList
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionList $questionList)
    {
        //
    }
}

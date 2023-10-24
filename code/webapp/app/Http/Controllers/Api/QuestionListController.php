<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionListRequest;
use App\Models\QuestionList;
use Illuminate\Http\Request;

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
        $question = Question::all();

        return response()->json([
            "status" => true,
            "questions" => [$question],
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
        $question = Question::create($request->all());

        return response()->json(
            [
                "status" => true,
                "message" => "Question created succesfully",
                "question" => $question,
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestionRequest $request, Question $question)
    {
        $question->update($request->all());

        return response()->json(
            [
                "status" => true,
                "message" => "Question updated succesfully",
                "question" => $question,
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return response()->json(
            [
                "status" => true,
                "message" => "Question deleted succesfully",
            ],
            200
        );
    }
}

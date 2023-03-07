<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

/**
 * 
 * @OA\Schema(
    * schema="Question",
    * @OA\Property(
    * property="id",
    * type="integer",
    * format="int64",
    * example=1
    * ),
    * @OA\Property(
    * property="question",
    * type="string",
    * example="Question 1"
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
 * 
 * @OA\Get(
    * path="/api/questions",
    * tags={"questions"},
    * summary="Get list of questions",
    * description="Returns list of questions",
    * operationId="questionsIndex",
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
                * property="questions",
                * type="array",
                * @OA\Items(ref="#/components/schemas/Question")
            * )
        * )
    * ),
    * @OA\Response(
        * response=401,
        * description="Unauthorized",
    * )
 * )
 * 
 * 
 * @OA\Post(
    * path="/api/questions",
    * tags={"questions"},
    * summary="Create new question",
    * description="Create new question",
    * operationId="questionsStore",
    * @OA\Parameter(
        * name="Authorization",
        * description="Bearer {token}",
        * in="header",
        * required=true,
    * ),
    * @OA\RequestBody(
        * required=true,
        * @OA\JsonContent(ref="#/components/schemas/Question")
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
            * )
        * )
    * ),
    * @OA\Response(
        * response=401,
        * description="Unauthorized"
    * ),
 * )
 * 
 * @OA\Patch(
    * path="/api/questions/{id}",
    * tags={"questions"},
    * summary="Update question",
    * description="Update question",
    * operationId="questionsUpdate",
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
    * @OA\RequestBody(
        * required=true,
        * @OA\JsonContent(ref="#/components/schemas/Question")
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
 * 
 * @OA\Delete(
    * path="/api/questions/{id}",
    * tags={"questions"},
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
 * 
*/

class QuestionController extends Controller
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
            'status' => true,
            'questions' => [$question]
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

        return response()->json([
            'status' => true,
            'message' => "Question created succesfully",
            'question' => $question
        ], 200);  
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

        return response()->json([
            'status' => true,
            'message' => "Question updated succesfully",
            'question' => $question
        ], 200); 
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

        return response()->json([
            'status' => true,
            'message' => "Question deleted succesfully",
        ], 200); 
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;

/**
 * @OA\Schema(
 *     schema="Answer",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="question_id",
 *         type="integer",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="answer",
 *         type="string",
 *         example="Answer 1"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2021-05-12 12:00:00"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2021-05-12 12:00:00"
 *     )
 * )
 * @OA\Get(
 * path="/api/answers",
 * tags={"answers"},
 * summary="Get list of answers",
 * description="Returns list of answers",
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
 * property="answers",
 * type="array",
 * @OA\Items(
 * ref="#/components/schemas/Answer"
 * )
 * ),
 * ),
 * ),
 * )
 * @OA\Post(
 * path="/api/answers",
 * tags={"answers"},
 * summary="Create new answer",
 * description="Create new answer",
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(ref="#/components/schemas/Answer")
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
 * property="message",
 * type="string",
 * example="Answer created succesfully"
 * ),
 * @OA\Property(
 * property="answer",
 * ref="#/components/schemas/Answer"
 * ),
 * ),
 * ),
 * )
 * @OA\Patch(
 * path="/api/answers/{id}",
 * tags={"answers"},
 * summary="Update answer",
 * description="Update answer",
 * @OA\Parameter(
 * name="id",
 * in="path",
 * description="ID of answer to update",
 * required=true,
 * @OA\Schema(
 * type="integer",
 * format="int64"
 * )
 * ),
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(ref="#/components/schemas/Answer")
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
 * property="message",
 * type="string",
 * example="Answer updated succesfully"
 * ),
 * @OA\Property(
 * property="answer",
 * ref="#/components/schemas/Answer"
 * ),
 * ),
 * ),
 * )
 * @OA\Delete(
 * path="/api/answers/{id}",
 * tags={"answers"},
 * summary="Delete answer",
 * description="Delete answer",
 * @OA\Parameter(
 * name="id",
 * in="path",
 * description="ID of answer to delete",
 * required=true,
 * @OA\Schema(
 * type="integer",
 * format="int64"
 * )
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
 * property="message",
 * type="string",
 * example="Answer deleted succesfully"
 * ),
 * ),
 * ),
 * )
 */

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answer = Answer::all();

        return response()->json([
            'status' => true,
            'answers' => [$answer]
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
    public function store(StoreAnswerRequest $request)
    {
        $answer = Answer::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Answer created succesfully",
            'answer' => $answer
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAnswerRequest $request, Answer $answer)
    {
        $answer->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Answer updated succesfully",
            'answer' => $answer
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return response()->json([
            'status' => true,
            'message' => "Answer deleted succesfully",
        ], 200);
    }
}

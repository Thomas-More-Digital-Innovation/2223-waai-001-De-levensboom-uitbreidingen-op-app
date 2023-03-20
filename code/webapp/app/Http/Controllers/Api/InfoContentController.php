<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInfoContentRequest;
use App\Models\InfoContent;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 * schema="InfoContent",
 * @OA\Property(
 * property="id",
 * type="integer",
 * format="int64",
 * example=1
 * ),
 * @OA\Property(
 * property="info_id",
 * type="integer",
 * format="int64",
 * example=1
 * ),
 * @OA\Property(
 * property="title",
 * type="string",
 * example="Title 1"
 * ),
 * @OA\Property(
 * property="description",
 * type="string",
 * example="Description 1"
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
 * path="/api/info-content",
 * tags={"infocontents"},
 * summary="Get list of info content",
 * description="Returns list of info content",
 * operationId="infoContentIndex",
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
 * type="object",
 * @OA\Property(
 * property="status",
 * type="boolean",
 * example=true
 * ),
 * @OA\Property(
 * property="infoContents",
 * type="array",
 * @OA\Items(
 * ref="#/components/schemas/InfoContent"
 * )
 * )
 * )
 * ),
 * @OA\Response(
 * response=401,
 * description="Unauthorized"
 * )
 * )
 * @OA\Post(
 * path="/api/info-content",
 * tags={"infocontents"},
 * summary="Create info content",
 * description="Create info content",
 * operationId="infoContentStore",
 * @OA\Parameter(
 * name="Authorization",
 * description="Bearer {token}",
 * in="header",
 * required=true,
 * ),
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(
 * ref="#/components/schemas/InfoContent"
 * )
 * ),
 * @OA\Response(
 * response=200,
 * description="successful operation",
 * @OA\JsonContent(
 * type="object",
 * @OA\Property(
 * property="status",
 * type="boolean",
 * example=true
 * ),
 * @OA\Property(
 * property="message",
 * type="string",
 * example="Info content created succesfully"
 * ),
 * @OA\Property(
 * property="infoContent",
 * ref="#/components/schemas/InfoContent"
 * )
 * )
 * ),
 * @OA\Response(
 * response=401,
 * description="Unauthorized"
 * ),
 * )
 * @OA\Patch(
 * path="/api/info-content/{id}",
 * tags={"infocontents"},
 * summary="Update info content",
 * description="Update info content",
 * operationId="infoContentUpdate",
 * @OA\Parameter(
 * name="Authorization",
 * description="Bearer {token}",
 * in="header",
 * required=true,
 * ),
 * @OA\Parameter(
 * name="id",
 * description="Info content id",
 * in="path",
 * required=true,
 * @OA\Schema(
 * type="integer",
 * format="int64",
 * example=1
 * )
 * ),
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(
 * ref="#/components/schemas/InfoContent"
 * )
 * ),
 * @OA\Response(
 * response=200,
 * description="successful operation",
 * @OA\JsonContent(
 * type="object",
 * @OA\Property(
 * property="status",
 * type="boolean",
 * example=true
 * ),
 * @OA\Property(
 * property="message",
 * type="string",
 * example="Info content updated succesfully"
 * ),
 * @OA\Property(
 * property="infoContent",
 * ref="#/components/schemas/InfoContent"
 * )
 * )
 * ),
 * @OA\Response(
 * response=401,
 * description="Unauthorized"
 * ),
 * )
 * @OA\Delete(
 * path="/api/info-content/{id}",
 * tags={"infocontents"},
 * summary="Delete info content",
 * description="Delete info content",
 * operationId="infoContentDelete",
 * @OA\Parameter(
 * name="Authorization",
 * description="Bearer {token}",
 * in="header",
 * required=true,
 * ),
 * @OA\Parameter(
 * name="id",
 * description="Info content id",
 * in="path",
 * required=true,
 * @OA\Schema(
 * type="integer",
 * format="int64",
 * example=1
 * )
 * ),
 * @OA\Response(
 * response=200,
 * description="successful operation",
 * @OA\JsonContent(
 * type="object",
 * @OA\Property(
 * property="status",
 * type="boolean",
 * example=true
 * ),
 * @OA\Property(
 * property="message",
 * type="string",
 * example="Info content deleted succesfully"
 * )
 * )
 * ),
 * @OA\Response(
 * response=401,
 * description="Unauthorized"
 * ),
 * )
 */

class InfoContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infoContent = InfoContent::all();

        return response()->json([
            'status' => true,
            'infoContents' => [$infoContent]
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
    public function store(StoreInfoContentRequest $request)
    {
        $infoContent = InfoContent::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Info content created succesfully",
            'infoContent' => $infoContent
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InfoContent  $infoContent
     * @return \Illuminate\Http\Response
     */
    public function show(InfoContent $infoContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InfoContent  $infoContent
     * @return \Illuminate\Http\Response
     */
    public function edit(InfoContent $infoContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InfoContent  $infoContent
     * @return \Illuminate\Http\Response
     */
    public function update(StoreInfoContentRequest $request, InfoContent $infoContent)
    {
        $infoContent->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Info content updated succesfully",
            'infoContent' => $infoContent
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InfoContent  $infoContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfoContent $infoContent)
    {
        $infoContent->delete();

        return response()->json([
            'status' => true,
            'message' => "Info content deleted succesfully",
        ], 200);
    }
}

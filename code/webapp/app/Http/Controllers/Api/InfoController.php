<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInfoRequest;
use App\Models\Info;
use Illuminate\Http\Request;

/**
 * 
 * @OA\Schema(
    * schema="Info",
    * @OA\Property(
        * property="id",
        * type="integer",
        * format="int64",
        * example=1
    * ),
    * @OA\Property(
        * property="name",
        * type="string",
        * example="Info 1" 
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
 *
 * 
 * @OA\Get(
    * path="/api/info",
    * tags={"infos"},
    * summary="Get list of info",
    * description="Returns list of info",
    * operationId="infoIndex",
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
                * property="info's",
                * type="array",
                * @OA\Items(ref="#/components/schemas/Info")
            * )
        * )
    * ),
    * @OA\Response(
        * response=401,
        * description="Unauthorized",
    * ),
 * )
 * 
 * @OA\Post(
    * path="/api/info",
    * tags={"infos"},
    * summary="Create info",
    * description="Create info",
    * operationId="infoStore",
    * @OA\Parameter(
        * name="Authorization",
        * description="Bearer {token}",
        * in="header",
        * required=true,
    * ),
    * @OA\RequestBody(
        * required=true,
        * @OA\JsonContent(ref="#/components/schemas/Info")
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
                * example="Info created succesfully"
            * ),
            * @OA\Property(
                * property="info",
                * ref="#/components/schemas/Info"
            * )
        * )
    * ),
    * @OA\Response(
        * response=401,
        * description="Unauthorized",
    * ),
 * )
 * 
 * @OA/Patch(
    * path="/api/info/{id}",
    * tags={"infos"},
    * summary="Update info",
    * description="Update info",
    * operationId="infoUpdate",
    * @OA\Parameter(
        * name="Authorization",
        * description="Bearer {token}",
        * in="header",
        * required=true,
    * ),
    * @OA\Parameter(
        * name="id",
        * description="Info id",
        * in="path",
        * required=true,
    * ),
    * @OA\RequestBody(
        * required=true,
        * request = "Info",
        * @OA\JsonContent(ref="#/components/schemas/Info"),
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
                * example="Info updated succesfully"
            * ),
            * @OA\Property(
                * property="info",
                * ref="#/components/schemas/Info"
            * ),
        * )
    * ),
    * @OA\Response(
        * response=401,
        * description="Unauthorized"
    * ),
 * )
 * 
 * @OA\Delete(
    * path="/api/info/{id}",
    * tags={"infos"},
    * summary="Delete info",
    * description="Delete info",
    * operationId="infoDelete",
    * @OA\Parameter(
        * name="Authorization",
        * description="Bearer {token}",
        * in="header",
        * required=true,
    * ),
    * @OA\Parameter(
        * name="id",
        * description="Info id",
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
                * property="message",
                * type="string",
                * example="Info deleted succesfully"
            * ),
        * )
    * ),
    * @OA\Response(
        * response=401,
        * description="Unauthorized"
    * )
 * )
 * 
*/

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = Info::all();

        return response()->json([
            'status' => true,
            'info\'s' => [$info]
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
    public function store(StoreInfoRequest $request)
    {
        $info = Info::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Info created succesfully",
            'info' => $info
        ], 200);  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit(Info $info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(StoreInfoRequest $request, Info $info)
    {
        $info->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Info updated succesfully",
            'info' => $info
        ], 200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Info $info)
    {
        $info->delete();

        return response()->json([
            'status' => true,
            'message' => "Info deleted succesfully",
        ], 200); 
    }
}

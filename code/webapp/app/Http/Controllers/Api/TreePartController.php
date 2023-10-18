<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTreePartRequest;
use App\Models\TreePart;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 * schema="TreePart",
 * @OA\Property(
 * property="id",
 * type="integer",
 * format="int64",
 * example=1
 * ),
 * @OA\Property(
 * property="treePart",
 * type="string",
 * example="TreePart 1"
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
 * path="/api/treeParts",
 * tags={"treeParts"},
 * summary="Get list of treeParts",
 * description="Returns list of treeParts",
 * operationId="treePartsIndex",
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
 * property="treeParts",
 * type="array",
 * @OA\Items(ref="#/components/schemas/TreePart")
 * )
 * )
 * ),
 * @OA\Response(
 * response=401,
 * description="Unauthorized",
 * )
 * )
 * @OA\Post(
 * path="/api/treeParts",
 * tags={"treeParts"},
 * summary="Create new treePart",
 * description="Create new treePart",
 * operationId="treePartsStore",
 * @OA\Parameter(
 * name="Authorization",
 * description="Bearer {token}",
 * in="header",
 * required=true,
 * ),
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(ref="#/components/schemas/TreePart")
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
 * property="treePart",
 * ref="#/components/schemas/TreePart"
 * )
 * )
 * ),
 * @OA\Response(
 * response=401,
 * description="Unauthorized"
 * ),
 * )
 * @OA\Patch(
 * path="/api/treeParts/{id}",
 * tags={"treeParts"},
 * summary="Update treePart",
 * description="Update treePart",
 * operationId="treePartsUpdate",
 * @OA\Parameter(
 * name="Authorization",
 * description="Bearer {token}",
 * in="header",
 * required=true,
 * ),
 * @OA\Parameter(
 * name="id",
 * description="TreePart id",
 * in="path",
 * required=true,
 * ),
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(ref="#/components/schemas/TreePart")
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
 * property="treePart",
 * ref="#/components/schemas/TreePart"
 * ),
 * ),
 * ),
 * @OA\Response(
 * response=401,
 * description="Unauthorized"
 * ),
 * )
 * @OA\Delete(
 * path="/api/treeParts/{id}",
 * tags={"treeParts"},
 * summary="Delete treePart",
 * description="Delete treePart",
 * operationId="treePartsDestroy",
 * @OA\Parameter(
 * name="Authorization",
 * description="Bearer {token}",
 * in="header",
 * required=true,
 * ),
 * @OA\Parameter(
 * name="id",
 * description="TreePart id",
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
 * property="treePart",
 * ref="#/components/schemas/TreePart"
 * ),
 * ),
 * ),
 * @OA\Response(
 * response=401,
 * description="Unauthorized"
 * ),
 * )
 */

class TreePartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $treeParts = TreePart::all();

        return response()->json([
            "status" => true,
            "treeParts" => [$treeParts],
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
    public function store(StoreTreePartRequest $request)
    {
        $treePart = TreePart::create($request->all());

        return response()->json(
            [
                "status" => true,
                "message" => "TreePart created succesfully",
                "treePart" => $treePart,
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TreePart  $treePart
     * @return \Illuminate\Http\Response
     */
    public function show(TreePart $treePart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TreePart  $treePart
     * @return \Illuminate\Http\Response
     */
    public function edit(TreePart $treePart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TreePart  $treePart
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTreePartRequest $request, TreePart $treePart)
    {
        $treePart->update($request->all());

        return response()->json(
            [
                "status" => true,
                "message" => "TreePart updated succesfully",
                "treePart" => $treePart,
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreePart  $treePart
     * @return \Illuminate\Http\Response
     */
    public function destroy(TreePart $treePart)
    {
        $treePart->delete();

        return response()->json(
            [
                "status" => true,
                "message" => "TreePart deleted succesfully",
            ],
            200
        );
    }
}

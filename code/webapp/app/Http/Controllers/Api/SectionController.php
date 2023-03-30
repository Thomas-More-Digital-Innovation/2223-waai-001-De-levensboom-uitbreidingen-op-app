<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 * schema="Section",
 * @OA\Property(
 * property="id",
 * type="integer",
 * format="int64",
 * example=1
 * ),
 * @OA\Property(
 * property="name",
 * type="string",
 * example="Section 1"
 * ),
 * @OA\Property(
 * property="description",
 * type="string",
 * example="Section 1"
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
 * path="/api/sections",
 * tags={"sections"},
 * summary="Get list of sections",
 * description="Returns list of sections",
 * operationId="sectionsIndex",
 * @OA\Parameter(
 *   name="Authorization",
 *   description="Bearer {token}",
 *   in="header",
 *   required=true,
 * ),
 * @OA\Response(
 *  response=200,
 *  description="successful operation",
 * @OA\JsonContent(
 * @OA\Property(
 * property="status",
 * type="boolean",
 * example=true
 * ),
 * @OA\Property(
 * property="sections",
 * type="array",
 * @OA\Items(ref="#/components/schemas/Section")
 * ),
 * ),
 * )
 * ),
 * @OA\Post(
 * path="/api/sections",
 * tags={"sections"},
 * summary="Create a new section",
 * description="Returns the created section",
 * operationId="sectionsStore",
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(ref="#/components/schemas/Section")
 * ),
 * @OA\Response(
 *  response=200,
 *  description="successful operation",
 * @OA\JsonContent(
 * @OA\Property(
 * property="status",
 * type="boolean",
 * example=true
 * ),
 * @OA\Property(
 * property="message",
 * type="string",
 * example="Section created succesfully"
 * ),
 * @OA\Property(
 * property="section",
 * ref="#/components/schemas/Section"
 * )
 * )
 * )
 * ),
 * @OA\Patch(
 * path="/api/sections/{id}",
 * tags={"sections"},
 * summary="Update a section",
 * description="Returns the updated section",
 * operationId="sectionsUpdate",
 * @OA\Parameter(
 * name="id",
 * in="path",
 * description="ID of section to return",
 * required=true,
 * ),
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(ref="#/components/schemas/Section")
 * ),
 * @OA\Response(
 *  response=200,
 *  description="successful operation",
 * @OA\JsonContent(
 * @OA\Property(
 * property="status",
 * type="boolean",
 * example=true
 * ),
 * @OA\Property(
 * property="message",
 * type="string",
 * example="Section updated succesfully"
 * ),
 * @OA\Property(
 * property="section",
 * ref="#/components/schemas/Section"
 * ),
 * ),
 * )
 * )
 * @OA\Delete(
 * path="/api/sections/{id}",
 * tags={"sections"},
 * summary="Delete a section",
 * description="Returns the deleted section",
 * operationId="sectionsDestroy",
 * @OA\Parameter(
 * name="id",
 * in="path",
 * description="ID of section to return",
 * required=true,
 * ),
 * @OA\Response(
 *  response=200,
 *  description="successful operation",
 * @OA\JsonContent(
 * @OA\Property(
 * property="status",
 * type="boolean",
 * example=true
 * ),
 * @OA\Property(
 * property="message",
 * type="string",
 * example="Section deleted succesfully"
 * ),
 * @OA\Property(
 * property="section",
 * ref="#/components/schemas/Section"
 * ),
 * ),
 * )
 * )
 */

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section = Section::all();

        return response()->json([
            "status" => true,
            "sections" => [$section],
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
    public function store(StoreSectionRequest $request)
    {
        $section = Section::create($request->all());

        return response()->json(
            [
                "status" => true,
                "message" => "Section created succesfully",
                "section" => $section,
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSectionRequest $request, Section $section)
    {
        $section->update($request->all());

        return response()->json(
            [
                "status" => true,
                "message" => "Section updated succesfully",
                "section" => $section,
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return response()->json(
            [
                "status" => true,
                "message" => "Section deleted succesfully",
            ],
            200
        );
    }
}

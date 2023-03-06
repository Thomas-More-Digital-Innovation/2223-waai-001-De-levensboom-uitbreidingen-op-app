<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentListRequest;
use App\Models\DepartmentList;
use Illuminate\Http\Request;

/**
 * 
 * @OA\Schema(
    * schema="DepartmentList",
    * @OA\Property(
        * property="id",
        * type="integer",
        * format="int64",
        * example=1
    * ),
    * @OA\Property(
        * property="name",
        * type="string",
        * example="Department 1"
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
    * path="/api/department-list",
    * tags={"Department List"},
    * summary="Get list of department list",
    * description="Returns list of department list",
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
                * property="departmentList",
                * type="array",
                * @OA\Items(
                    * ref="#/components/schemas/DepartmentList"
                * )
            * )
        * )
    * )
 * )
 * 
 * @OA\Post(
    * path="/api/department-list",
    * tags={"Department List"},
    * summary="Create new department list",
    * description="Create new department list",
    * @OA\RequestBody(
        * required=true,
        * @OA\JsonContent(ref="#/components/schemas/DepartmentList")
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
                * example="Department List created succesfully"
            * ),
            * @OA\Property(
                * property="departmentList",
                * ref="#/components/schemas/DepartmentList"
            * )
        * )
    * )
 * )
 * 
 * @OA\Patch(
    * path="/api/department-list/{id}",
    * tags={"Department List"},
    * summary="Update department list",
    * description="Update department list",
    * @OA\Parameter(
        * name="id",
        * in="path",
        * description="Department List ID",
        * required=true,
        * @OA\Schema(
            * type="integer",
            * format="int64"
        * )
    * ),
    * @OA\RequestBody(
        * required=true,
        * @OA\JsonContent(ref="#/components/schemas/DepartmentList")
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
                * example="Department List updated succesfully"
            * ),
            * @OA\Property(
                * property="departmentList",
                * ref="#/components/schemas/DepartmentList"
            * )
        * )
    * )
 * )
 * 
 * @OA\Delete(
    * path="/api/department-list/{id}",
    * tags={"Department List"},
    * summary="Delete department list",
    * description="Delete department list",
    * @OA\Parameter(
        * name="id",
        * in="path",
        * description="Department List ID",
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
                * example="Department List deleted succesfully"
            * )
        * )
    * )
 * )
 * 
*/

class DepartmentListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departmentList = DepartmentList::all();

        return response()->json([
            'status' => true,
            'departmentList' => [$departmentList]
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
    public function store(StoreDepartmentListRequest $request)
    {
        $departmentList = DepartmentList::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Department List created succesfully",
            'departmentList' => $departmentList
        ], 200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DepartmentList  $departmentList
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentList $departmentList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DepartmentList  $departmentList
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentList $departmentList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DepartmentList  $departmentList
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDepartmentListRequest $request, DepartmentList $departmentList)
    {
        $departmentList->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Department List updated succesfully",
            'departmentList' => $departmentList
        ], 200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepartmentList  $departmentList
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentList $departmentList)
    {
        $departmentList->delete();

        return response()->json([
            'status' => true,
            'message' => "Department List deleted succesfully",
        ], 200); 
    }
}

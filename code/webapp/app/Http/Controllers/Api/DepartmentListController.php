<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentListRequest;
use App\Models\DepartmentList;
use Illuminate\Http\Request;

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
            'departmentLists' => [$departmentList]
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
            'department' => $departmentList
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
    public function update(StoreDepartmentRequest $request, DepartmentList $departmentList)
    {
        $departmentList->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Department List updated succesfully",
            'department' => $departmentList
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

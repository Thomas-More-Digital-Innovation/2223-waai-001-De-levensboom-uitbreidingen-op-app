<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * @OA\Schema(
     * schema="Department",
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
     *  @OA\Property(
         * property="updated_at",
         * type="string",
         * format="date-time",
         * example="2021-05-01 12:00:00"
     * ),
 * )
*/

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = Department::all();

        return response()->json([
            'status' => true,
            'department' => [$department]
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
    public function store(StoreDepartmentRequest $request)
    {
        // Use this Gate function to authorize the action
        Gate::authorize('createDestroyTable');

        $department = Department::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Department created succesfully",
            'department' => $department
        ], 200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDepartmentRequest $request, Department $department)
    {
        // Use this Gate function to authorize the action
        Gate::authorize('editDepartment', $department->id);

        $department->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Department updated succesfully",
            'department' => $department
        ], 200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        // Use this Gate function to authorize the action
        Gate::authorize('createDestroyTable');
        
        $department->delete();

        return response()->json([
            'status' => true,
            'message' => "Department List deleted succesfully",
        ], 200); 
    }
}

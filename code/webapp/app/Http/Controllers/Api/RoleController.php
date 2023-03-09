<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

/**
 *  
 * 
 * @OA\Schema(
 * schema="Role",
    * @OA\Property(
    * property="id",
    * type="integer",
    * format="int64",
    * example=1
    * ),
    * @OA\Property(
    * property="name",
    * type="string",
    * example="Role 1"
    * ),
    * @OA\Property(
    * property="description",
    * type="string",
    * example="Role 1"
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
 * path="/api/roles",
 * tags={"roles"},
 * summary="Get list of roles",
 * description="Returns list of roles",
 * operationId="rolesIndex",
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
                * property="roles",
                * type="array",
                * @OA\Items(ref="#/components/schemas/Role")
            * )
        * )
    * ),
 * )
 * 
 * @OA\Post(
 * path="/api/roles",
 * tags={"roles"},
 * summary="Create a new role",
 * description="Returns the created role",
 * operationId="rolesStore",
    * @OA\Parameter(
        * name="Authorization",
        * description="Bearer {token}",
        * in="header",
        * required=true,
    * ),
    * @OA\RequestBody(
        * required=true,
        * @OA\JsonContent(ref="#/components/schemas/Role")
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
                * example="Role created succesfully"
            * ),
            * @OA\Property(
                * property="role",
                * ref="#/components/schemas/Role"
            * )
        * )
    * ),
 * )
 * 
 * 
 * @OA\Patch(
 * path="/api/roles/{id}",
 * tags={"roles"},
 * summary="Update a role",
 * description="Returns the updated role",
 * operationId="rolesUpdate",
    * @OA\Parameter(
        * name="Authorization",
        * description="Bearer {token}",
        * in="header",
        * required=true,
    * ),
    * @OA\Parameter(
        * name="id",
        * description="Role id",
        * in="path",
        * required=true,
    * ),
    * @OA\RequestBody(
        * required=true,
        * @OA\JsonContent(ref="#/components/schemas/Role")
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
                * example="Role updated succesfully"
            * ),
            * @OA\Property(
                * property="role",
                * ref="#/components/schemas/Role"
            * )
        * )
    * ),
 * )
 * 
 * @OA\Delete(
 * path="/api/roles/{id}",
 * tags={"roles"},
 * summary="Delete a role",
 * description="Returns the deleted role",
 * operationId="rolesDelete",
    * @OA\Parameter(
        * name="Authorization",
        * description="Bearer {token}",
        * in="header",
        * required=true,
    * ),
    * @OA\Parameter(
        * name="id",
        * description="Role id",
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
                * example="Role deleted succesfully"
            * ),
            * @OA\Property(
                * property="role",
                * ref="#/components/schemas/Role"
            * )
        * )
    * ),
 * )
 *
*/

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('notClient');
        $role = Role::all();

        return response()->json([
            'status' => true,
            'roles' => [$role]
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
    public function store(StoreRoleRequest $request)
    {
        Gate::authorize('allowAdmin');
        $role = Role::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Role created succesfully",
            'role' => $role
        ], 200);  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
        Gate::authorize('allowAdmin');
        $role->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Role updated succesfully",
            'role' => $role
        ], 200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Gate::authorize('allowAdmin');
        $role->delete();

        return response()->json([
            'status' => true,
            'message' => "Role deleted succesfully",
        ], 200); 
    }
}

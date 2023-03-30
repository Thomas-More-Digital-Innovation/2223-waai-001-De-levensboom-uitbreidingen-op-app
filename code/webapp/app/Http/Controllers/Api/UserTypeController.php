<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserTypeRequest;
use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    /**
     * @OA\Schema(
     * schema="UserType",
     * @OA\Property(
     * property="id",
     * type="integer",
     * format="int64",
     * example=1
     * ),
     * @OA\Property(
     * property="name",
     * type="string",
     * example="Admin"
     * ),
     * @OA\Property(
     * property="description",
     * type="string",
     * example="Admin"
     * ),
     * @OA\Property(
     * property="created_at",
     * type="string",
     * format="date-time",
     * example="2021-01-01 00:00:00"
     * ),
     * @OA\Property(
     * property="updated_at",
     * type="string",
     * format="date-time",
     * example="2021-01-01 00:00:00"
     * ),
     * )
     * @OA\Get(
     * path="/api/userTypes",
     * tags={"userTypes"},
     * summary="Get list of userTypes",
     * description="Returns list of userTypes",
     * operationId="userTypesIndex",
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
     *  @OA\Property(
     *  property="status",
     *  type="boolean",
     *  example=true
     * ),
     * @OA\Property(
     *  property="userTypes",
     *  type="array",
     *  @OA\Items(ref="#/components/schemas/UserType")
     * ),
     * ),
     * ),
     * ),
     * @OA\Post(
     * path="/api/userTypes",
     * tags={"userTypes"},
     * summary="Create a new userType",
     * description="Returns the created userType",
     * operationId="userTypesStore",
     * @OA\RequestBody(
     *  required=true,
     *  @OA\JsonContent(ref="#/components/schemas/UserType")
     * ),
     * @OA\Response(
     *  response=200,
     *  description="successful operation",
     * @OA\JsonContent(
     *  @OA\Property(
     *  property="status",
     *  type="boolean",
     *  example=true
     * ),
     * @OA\Property(
     *  property="message",
     *  type="string",
     *  example="User type created succesfully"
     * ),
     * @OA\Property(
     *  property="userType",
     *  ref="#/components/schemas/UserType"
     * ),
     * ),
     * ),
     * ),
     * @OA\Patch(
     * path="/api/userTypes/{id}",
     * tags={"userTypes"},
     * summary="Update an existing userType",
     * description="Returns the updated userType",
     * operationId="userTypesUpdate",
     * @OA\Parameter(
     *  name="id",
     *  in="path",
     *  description="ID of userType to return",
     *  required=true,
     * ),
     * @OA\Response(
     *  response=200,
     *  description="successful operation",
     * @OA\JsonContent(
     *  @OA\Property(
     *  property="status",
     *  type="boolean",
     *  example=true
     * ),
     * @OA\Property(
     *  property="message",
     *  type="string",
     *  example="User type updated succesfully"
     * ),
     * @OA\Property(
     *  property="userType",
     *  ref="#/components/schemas/UserType"
     * ),
     * ),
     * ),
     * ),
     * @OA\Delete(
     * path="/api/userTypes/{id}",
     * tags={"userTypes"},
     * summary="Delete an existing userType",
     * description="Returns the deleted userType",
     * operationId="userTypesDelete",
     * @OA\Parameter(
     *  name="id",
     *  in="path",
     *  description="ID of userType to return",
     *  required=true,
     * ),
     * @OA\Response(
     *  response=200,
     *  description="successful operation",
     * @OA\JsonContent(
     *  @OA\Property(
     *  property="status",
     *  type="boolean",
     *  example=true
     * ),
     * @OA\Property(
     *  property="message",
     *  type="string",
     *  example="User type deleted succesfully"
     * ),
     * @OA\Property(
     *  property="userType",
     *  ref="#/components/schemas/UserType"
     * ),
     * ),
     * ),
     * ),
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize("notClient");
        $userTypes = UserType::all();

        return response()->json([
            "status" => true,
            "userTypes" => $userTypes,
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
    public function store(StoreUserTypeRequest $request)
    {
        Gate::authorize("allowAdmin");
        $userType = UserType::create($request->all());

        return response()->json(
            [
                "status" => true,
                "message" => "User type created succesfully",
                "userType" => $userType,
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function show(UserType $userType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function edit(UserType $userType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserTypeRequest $request, UserType $userType)
    {
        Gate::authorize("allowAdmin");
        $userType->update($request->all());

        return response()->json(
            [
                "status" => true,
                "message" => "User type updated succesfully",
                "userType" => $userType,
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserType $userType)
    {
        Gate::authorize("allowAdmin");
        $userType->delete();

        return response()->json(
            [
                "status" => true,
                "message" => "User type deleted succesfully",
            ],
            200
        );
    }
}

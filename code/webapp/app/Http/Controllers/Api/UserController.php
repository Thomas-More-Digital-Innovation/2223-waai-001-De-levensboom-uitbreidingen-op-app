<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *  schema="User",
 * @OA\Property(
 * property="id",
 * type="integer",
 * format="int64",
 * example=1
 * ),
 * @OA\Property(
 * property="user_type_id",
 * type="integer",
 * format="int64",
 * example=1
 * ),
 * @OA\Property(
 * property="firstname",
 * type="string",
 * example="John"
 * ),
 * @OA\Property(
 * property="surname",
 * type="string",
 * example="Doe"
 * ),
 * @OA\Property(
 * property="email",
 * type="string",
 * example="john.doe@email.com"
 * ),
 * @OA\Property(
 * property="password",
 * type="string",
 * example="password"
 * ),
 * @OA\Property(
 * property="phoneNumber",
 * type="string",
 * example="0612345678"
 * ),
 * @OA\Property(
 * property="gender",
 * type="string",
 * example="Man"
 * ),
 * @OA\Property(
 * property="street",
 * type="string",
 * example="street"
 * ),
 * @OA\Property(
 * property="houseNumber",
 * type="string",
 * example="1"
 * ),
 * @OA\Property(
 * property="city",
 * type="string",
 * example="city"
 * ),
 * @OA\Property(
 * property="zipcode",
 * type="string",
 * example="1234AB"
 * ),
 * @OA\Property(
 * property="created_at",
 * type="string",
 * format="date-time",
 * example="2021-05-12 12:00:00"
 * ),
 * @OA\Property(
 * property="updated_at",
 * type="string",
 * format="date-time",
 * example="2021-05-12 12:00:00"
 * ),
 * )
 * @OA\Get(
 * path="/api/users",
 * tags={"users"},
 * summary="Get list of users",
 * description="Returns list of users",
 * operationId="usersIndex",
 * @OA\Parameter(
 *   name="Authorization",
 *   description="Bearer {token}",
 *   in="header",
 *   required=true,
 * ),
 * @OA\Response(
 *  response=200,
 *  description="successful operation",
 *  @OA\JsonContent(
 *   @OA\Property(
 *    property="status",
 *    type="boolean",
 *    example=true
 *   ),
 *   @OA\Property(
 *     property="users",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/User")
 *   ),
 *  ),
 * ),
 * )
 * @OA\Post(
 * path="/api/users",
 * tags={"users"},
 * summary="Create new user",
 * description="Create new user",
 * operationId="usersStore",
 * @OA\RequestBody(
 * required=true,
 * description="Pass user data",
 * @OA\JsonContent(ref="#/components/schemas/User")
 * ),
 * @OA\Response(
 * response=200,
 * description="successful operation",
 * @OA\JsonContent(
 * @OA\Property(
 *  property="status",
 *  type="boolean",
 *  example=true
 * ),
 * @OA\Property(
 *  property="message",
 *  type="string",
 *  example="User created succesfully"
 * ),
 * @OA\Property(
 *  property="user",
 *  ref="#/components/schemas/User"
 * ),
 * ),
 * ),
 * )
 * @OA\Patch(
 * path="/api/users/{id}",
 * tags={"users"},
 * summary="Update existing user",
 * description="Update existing user",
 * operationId="usersUpdate",
 * @OA\Parameter(
 * name="id",
 * in="path",
 * description="ID of user to return",
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
 * example="User updated succesfully"
 * ),
 * @OA\Property(
 * property="user",
 * ref="#/components/schemas/User"
 * ),
 * ),
 * ),
 * )
 * @OA\Delete(
 * path="/api/users/{id}",
 * tags={"users"},
 * summary="Delete existing user",
 * description="Delete existing user",
 * operationId="usersDestroy",
 * @OA\Parameter(
 * name="id",
 * in="path",
 * description="ID of user to return",
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
 * example="User deleted succesfully"
 * ),
 * ),
 * ),
 * )
 */

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('notClient');
        $user = User::all();

        return response()->json([
            'status' => true,
            'users' => [$user]

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
    public function store(StoreUserRequest $request)
    {
        Gate::authorize('adminOrDep');
        $user = User::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "User created succesfully",
            'user' => $user
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, User $user)
    {
        Gate::authorize('editAccount', $user);
        $user->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "User updated succesfully",
            'user' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Gate::authorize('adminOrDep');
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => "User deleted succesfully",
        ], 200);
    }
}

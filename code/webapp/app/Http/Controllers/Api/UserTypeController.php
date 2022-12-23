<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserTypeRequest;
use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userTypes = UserType::all();

        return response()->json([
            'status' => true,
            'userTypes' => $userTypes
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
        $userType = UserType::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "User type created succesfully",
            'userType' => $userType
        ], 200);
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
        $userType -> update($request->all());

        return response()->json([
            'status' => true,
            'message' => "User type updated succesfully",
            'userType' => $userType
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserType $userType)
    {
        $userType -> delete();

        return response()->json([
            'status' => true,
            'message' => "User type deleted succesfully"
        ], 200);
    }
}

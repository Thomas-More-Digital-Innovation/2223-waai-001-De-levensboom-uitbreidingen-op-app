<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInfoContentRequest;
use App\Models\InfoContent;
use Illuminate\Http\Request;

class InfoContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infoContent = InfoContent::all();

        return response()->json([
            'status' => true,
            'infoContents' => [$infoContent]
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
    public function store(StoreInfoContentRequest $request)
    {
        $infoContent = InfoContent::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Info content created succesfully",
            'infoContent' => $infoContent
        ], 200);  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InfoContent  $infoContent
     * @return \Illuminate\Http\Response
     */
    public function show(InfoContent $infoContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InfoContent  $infoContent
     * @return \Illuminate\Http\Response
     */
    public function edit(InfoContent $infoContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InfoContent  $infoContent
     * @return \Illuminate\Http\Response
     */
    public function update(StoreInfoContentRequest $request, InfoContent $infoContent)
    {
        $infoContent->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Info content updated succesfully",
            'infoContent' => $infoContent
        ], 200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InfoContent  $infoContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfoContent $infoContent)
    {
        $infoContent->delete();

        return response()->json([
            'status' => true,
            'message' => "Info content deleted succesfully",
        ], 200); 
    }
}

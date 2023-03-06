<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\InfoContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TeenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('notClient');

        $teens = Info::where('section_id', 2)->get();
        $infoContents = InfoContent::all();
        return view('teens.index', compact('teens','infoContents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('allowAdmin');

        return view('teens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('allowAdmin');

        $highestOrderNumber = Info::where('section_id', 2)->max('orderNumber');
        $request->request->add(['orderNumber' => $highestOrderNumber + 1]);

        $request->request->add(['section_id' => 2]);
        Info::create($request->all());

        $msg = "New Teen Info Content Created successful! ";
        return redirect('teens')->with('msg', $msg);
    }

    public function updateOrder(Request $request)
    {
        Gate::authorize('allowAdmin');

        $info = Info::find($request->teen);
        $orderNumber = $info->orderNumber;

        if ($request->order == 'up') {
            $other = Info::where('section_id', 2)
                ->where('orderNumber', '<', $orderNumber)
                ->orderBy('orderNumber', 'desc')
                ->first();

            if ($other) {
                $other->orderNumber += 1;
                $other->save();
                $info->orderNumber -= 1;
                $info->save();
            }
        } else {
            $other = Info::where('section_id', 2)
                ->where('orderNumber', '>', $orderNumber)
                ->orderBy('orderNumber', 'asc')
                ->first();

            if ($other) {
                $other->orderNumber -= 1;
                $other->save();
                $info->orderNumber += 1;
                $info->save();
            }
        }

        $teens = Info::where('section_id', 2)->orderBy('orderNumber')->get();
        $infoContents = InfoContent::all();
        $msg = "Teens order updated successfully!";

        return view('teens.index', compact('teens', 'infoContents', 'msg'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('allowAdmin');

        $teen = Info::find($id);
        $infoContents = InfoContent::where('info_id', $id)->get();
        return view('teens.edit', compact('teen','infoContents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('allowAdmin');
        
        $teen = Info::find($id);
        $teen->update($request->all());

        $msg = "Teen Info Content Updated successful! ";
        return redirect('teens')->with('msg', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('allowAdmin');
        
        InfoContent::where('info_id', $id)->delete();
        $teen = Info::find($id);
        $teen->delete();

        $msg = "Teen Info Content Deleted successful! ";
        return redirect('teens')->with('msg', $msg);
    }
}

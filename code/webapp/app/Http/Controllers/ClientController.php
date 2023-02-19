<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::where('user_type_id', 2)->get();

        foreach ($clients as $client) {
            $departmentList = DepartmentList::where('user_id', $client->id)->first();
            if ($departmentList) {
                $department = Department::find($departmentList->department_id);
                $client->departments = $department->name;
            } else {
                $client->departments = "";
            }
        }
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        Gate::authorize('createDestroyTable');

        $departments = Department::all();
        $mentors = User::where('user_type_id', 1)->get();
        return view('clients.create', compact('departments', 'mentors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('createDestroyTable');

        $request->request->add(['user_type_id' => 2]);
        $request->request->add(['password' => bcrypt('password')]);
        User::create($request->all());

        if (!$request->department == "") {
            DepartmentList::create([
                'user_id' => User::latest()->first()->id,
                'department_id' => $request->department,
                'role_id' => 2,
            ]);
        }



        $msg = "New Client Created successful! ";
        return redirect('clients')->with('msg', $msg);
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
    
        Gate::authorize('editUser', $id);

        $client = User::find($id);
        $departments = Department::all();
        $mentors = User::where('user_type_id', 1)->get();
        return view('clients.edit', compact('client', 'departments', 'mentors'));
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
        Gate::authorize('editUser', $id);

        $client = User::find($id);
        $client->update($request->all());

        $msg = "Client Updated successful! ";
        return redirect('clients')->with('msg', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('createDestroyTable');

        DepartmentList::where('user_id', $id)->delete();
        $client = User::find($id);
        $client->delete();

        $msg = "Client Deleted successful! ";
        return redirect('clients')->with('msg', $msg);
    }
}

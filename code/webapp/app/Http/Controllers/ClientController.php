<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Department;
use App\Models\DepartmentList;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Events\Registered;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('notClient');
              
        $clients = User::where('user_type_id', 2)->get();
        $departments = Department::all();
        $departmentLists = DepartmentList::all();
        $mentors = User::where('user_type_id', 1)->orWhere('user_type_id', 3)->get();

        return view('clients.index', compact('clients', 'departments', 'departmentLists', 'mentors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('adminOrDep');

        $departments = Department::all();
        $departmentLists = DepartmentList::all();
        $mentors = User::where('user_type_id', 1)->orWhere('user_type_id', 3)->get();
        return view('clients.create', compact('departments', 'departmentLists', 'mentors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        Gate::authorize('adminOrDep');

        $request->request->add(['user_type_id' => 2]);
        $request->request->add(['password' => bcrypt('password')]);
        $user = User::create($request->all());

        event(new Registered($user));

        for ($i = 0; $i <= $request->totalDep; $i++) {
            $department = $request->input('department' . $i);
            $mentor = $request->input('mentor' . $i);
            if($department != null) {
                DepartmentList::create([
                    'user_id' => User::latest()->first()->id,
                    'department_id' => $department,
                    'role_id' => 2,
                ]);
            }
        }
        // Still need to create UserList, this to connect the client to the mentor

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
        Gate::authorize('adminOrDep');

        $client = User::find($id);
        $departments = Department::all();
        $departmentsList = DepartmentList::all();
        $userDepartments = DepartmentList::where('user_id', $id)->get();
        $mentors = User::where('user_type_id', 1)->orWhere('user_type_id', 3)->get();
        return view('clients.edit', compact('client', 'departments', 'departmentsList', 'mentors', 'userDepartments'));

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
        Gate::authorize('adminOrDep');

        $client = User::find($id);
        $client->update($request->all());

        DepartmentList::Where('user_id', $id)->delete();
        for ($i = 0; $i <= $request->totalDep; $i++) {
            $department = $request->input('department' . $i);
            $mentor = $request->input('mentor' . $i);
            if($department != null) {
                DepartmentList::create([
                    'user_id' => $id,
                    'department_id' => $department,
                    'role_id' => 2,
                ]);
            }
        }

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
        Gate::authorize('adminOrDep');

        DepartmentList::where('user_id', $id)->delete();
        $client = User::find($id);
        $client->delete();

        $msg = "Client Deleted successful! ";
        return redirect('clients')->with('msg', $msg);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Department;
use App\Models\DepartmentList;
use App\Models\Role;
use App\Models\User;
use App\Models\UserType;
use App\Models\UserList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize("notClient");

        $mentors = User::where("user_type_id", 1)
            ->orWhere("user_type_id", 3)
            ->get();

        foreach ($mentors as $mentor) {
            $user_type = UserType::find($mentor->user_type_id);
            $mentor->user_type = $user_type->name;
        }

        $departmentLists = DepartmentList::all();
        $departments = Department::all();

        return view(
            "mentors.index",
            compact("mentors", "departmentLists", "departments")
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize("adminOrDep");

        $departments = Department::all();
        $roles = Role::where("name", "Department Head")
            ->orWhere("name", "Mentor")
            ->get();
        return view("mentors.create", compact("departments", "roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        Gate::authorize("adminOrDep");
        
        $user_type = $request->has('user_type_id') ? 1 : 3;
        $request->request->add(["user_type_id" => $user_type]);
        $request->request->add(["password" => bcrypt("veranderMij")]);
        $user = User::create($request->all());

        event(new Registered($user));

        for ($i = 0; $i <= $request->totalDep; $i++) {
            $department = $request->input("department" . $i);
            $role = $request->input("role" . $i);
            if ($department != null && $role != null) {
                DepartmentList::create([
                    "user_id" => User::latest()->first()->id,
                    "department_id" => $department,
                    "role_id" => $role,
                ]);
            }
        }

        $msg = "New Mentor Created successful! ";
        return redirect("mentors")->with("msg", $msg);
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
        Gate::authorize("editAccount", $id);
        $mentor = User::find($id);
        $departments = Department::all();
        $roles = Role::where("name", "Department Head")
            ->orWhere("name", "Mentor")
            ->get();
        $departmentsList = DepartmentList::where("user_id", $id)->get();
        return view("mentors.edit", compact("mentor", "departments", "roles"), [
            "departmentsList" => $departmentsList,
        ]);
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
        Gate::authorize("editAccount", $id);

        $mentor = User::find($id);
        $mentor->update($request->all());

        DepartmentList::Where("user_id", $id)->delete();

        for ($i = 0; $i <= $request->totalDep; $i++) {
            $department = $request->input("department" . $i);
            $role = $request->input("role" . $i);
            if ($department != null && $role != null) {
                DepartmentList::create([
                    "user_id" => $id,
                    "department_id" => $department,
                    "role_id" => $role,
                ]);
            }
        }

        $msg = "Mentor Updated successful! ";
        return redirect("mentors")->with("msg", $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize("adminOrDep");

        DepartmentList::where("user_id", $id)->delete();
        UserList::where("mentor_id", $id)->delete();
        $mentor = User::find($id);
        $mentor->delete();

        $msg = "Mentor Deleted successful! ";
        return redirect("mentors")->with("msg", $msg);
    }
}

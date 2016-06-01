<?php

namespace Mahesvaran\LaravelAcl\Controllers;

use Session;
use Carbon\Carbon;
use Mahesvaran\LaravelAcl\Models\Role;
use Mahesvaran\LaravelAcl\Models\Permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mahesvaran\LaravelAcl\Requests\RoleRequest;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::paginate(15);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::lists('name', 'id');
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());
        $this->syncPermissions($role, $request->input('permission_list'));
        Session::flash('flash_message', 'Role added!');
        return redirect('roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::lists('name', 'id');
        return view('roles.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::lists('name', 'id');
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, RoleRequest $request)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
        $this->syncPermissions($role, $request->input('permission_list'));
        Session::flash('flash_message', 'Role updated!');
        return redirect('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        Session::flash('flash_message', 'Role deleted!');
        return redirect('roles');
    }

    private function syncPermissions(Role $role, $permissions)
    {
        if (!empty($permissions)) {
            $role->permissions()->sync($permissions);
        }
    }

    public function showRoles(\App\User $user)
    {
        return view('users.roles', compact('user'));
    }

    public function editRoles(\App\User $user)
    {
        $roles = Role::lists('description', 'id');
        return view('users.edit_role', compact('user', 'roles'));
    }

    public function updateRoles($id, Request $request)
    {
        $user->roles()->sync($request->input('role_list'));
        Session::flash('flash_message', 'User\'s roles updated!');
        return redirect('/users/' . $user->id);
    }
}

<?php

namespace Mahesvaran\LaravelAcl\Controllers;

use Session;
use Carbon\Carbon;
use Mahesvaran\LaravelAcl\Models\Permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mahesvaran\LaravelAcl\Requests\PermissionRequest;

class PermissionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::paginate(15);
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PermissionRequest $request)
    {
        Permission::create($request->all());
        Session::flash('flash_message', 'Permission added!');
        return redirect('permissions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, PermissionRequest $request)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        Session::flash('flash_message', 'Permission updated!');
        return redirect('permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Permission::destroy($id);
        Session::flash('flash_message', 'Permission deleted!');
        return redirect('permissions');
    }
}

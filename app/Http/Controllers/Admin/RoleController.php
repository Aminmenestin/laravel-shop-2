<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::latest()->paginate(10);
        return view('admin.roles.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'display_name' => 'required'
        ]);

        try {
            DB::beginTransaction();


            $role = Role::create([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'guard_name' => 'web'
            ]);

            $permission = $request->except('_token', 'display_name', 'name');
            $role->givePermissionTo($permission);


            DB::commit();

            alert()->success('پرمیشن ایجاد شد');
            return redirect()->route('admin.permissions.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error($ex->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show' , compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit' , compact('role' , 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required'
        ]);

        try {
            DB::beginTransaction();


            $role->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);

            $permission = $request->except('_token', 'display_name', 'name' , '_method');
            $role->syncPermissions($permission);


            DB::commit();

            alert()->success('پرمیشن ویرایش شد');
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

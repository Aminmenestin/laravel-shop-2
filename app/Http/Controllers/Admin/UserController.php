<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            DB::beginTransaction();


            $user->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);

            $user->syncRoles($request->role);
            $permission = $request->except('_token','role', 'display_name', 'name', '_method' , 'cellphone');
            $user->syncPermissions($permission);


            DB::commit();

            alert()->success('کاربر ویرایش شد');
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

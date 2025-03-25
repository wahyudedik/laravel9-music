<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailMail;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRoleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        if ($request->has('search')) {
            $search = $request->input('search');

            $roles = Role::with('permissions')->where('name', 'like', "%$search%")
                ->latest()
                ->paginate($perPage);
        } else {
            $roles = Role::with('permissions')->paginate($perPage);
        }

        return view('admin.roles.index', compact('roles'));
    }


    public function create()
    {
        $authUser = Auth::user();
        activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' visited create role form');
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction(); // Start transaction

            // Validate input
            $request->validate([
                'name' => 'required|string|max:255|unique:roles,name',
                'guard_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'permissions' => 'array', // Ensure permissions are an array
                'permissions.*' => 'exists:permissions,id', // Ensure each permission exists
            ]);

            // Create new role
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => $request->guard_name,
                'description' => $request->description ?? null,
            ]);

            // Assign permissions if provided
            if ($request->has('permissions')) {
                $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
                $role->syncPermissions($permissions);
            }

            // Log activity
            $authUser = Auth::user();
            activity()->withProperties(['ip' => request()->ip()])
                ->log($authUser->name . ' created a role: ' . $role->name);

            DB::commit(); // Commit transaction

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role successfully created');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on error

            return redirect()->route('admin.roles.index')
                ->with('error', 'An error occurred while creating the role: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $authUser = Auth::user();
        activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' visited edit role form');

        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction(); // Start transaction

            // Validate input
            $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $id, // Ignore current role's name
                'guard_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'permissions' => 'nullable|array', // Allow null (no permissions selected)
                'permissions.*' => 'exists:permissions,id', // Ensure each permission exists
            ]);

            // Find the role by ID
            $role = Role::findOrFail($id);

            // Update role details
            $role->update([
                'name' => $request->name,
                'guard_name' => $request->guard_name,
                'description' => $request->description ?? null,
            ]);

            // Sync permissions only if permissions are provided
            if ($request->has('permissions')) {
                $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
                $role->syncPermissions($permissions);
            } else {
                $role->syncPermissions([]); // Remove all permissions if none selected
            }

            // Log activity
            $authUser = Auth::user();
            activity()->withProperties(['ip' => request()->ip()])
                ->log($authUser->name . ' updated role: ' . $role->name);

            DB::commit(); // Commit transaction

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role successfully updated.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on error

            return redirect()->route('admin.roles.index')
                ->with('error', 'An error occurred while updating the role: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Find the role by ID
            $role = Role::findOrFail($id);

            // Ensure the role is not a protected role (optional check)
            if (in_array($role->name, ['Super Admin', 'Admin', 'User'])) {
                return response()->json([
                    'error' => 'This role cannot be deleted!',
                ], 403);
            }

            // Delete the role
            $role->delete();

            // Log activity
            $authUser = Auth::user();
            activity()->withProperties(['ip' => request()->ip()])
                ->log($authUser->name . ' deleted role: ' . $role->name);

            // Return response
            return response()->json([
                'success' => 'Role successfully deleted.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while deleting the role!',
            ], 500);
        }
    }
}

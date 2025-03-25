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

use App\Models\User;
use App\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminPermissionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        if ($request->has('search')) {
            $search = $request->input('search');

            $permissions = Permission::where('name', 'like', "%$search%")
                ->latest()
                ->paginate($perPage);
        } else {
            $permissions = Permission::paginate($perPage);
        }

        return view('admin.roles.permissions', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'description' => 'nullable|string',
            'guard_name' => 'required|string|max:255',
        ]);

        // Create a new permission
        $permission = Permission::create([
            'name' => $request->name,
            'description' => $request->description,
            'guard_name' => $request->guard_name,
        ]);

        $authUser = Auth::user();
        activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . 'create permission');

        // Return response
        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission successfully created.');
    }

    public function update(Request $request, $id)
    {
        // Find the permission by ID
        $permission = Permission::findOrFail($id);

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
            'description' => 'nullable|string',
            'guard_name' => 'required|string|max:255',
        ]);

        // Update permission data
        $permission->update([
            'name' => $request->name,
            'description' => $request->description,
            'guard_name' => $request->guard_name,
        ]);

        $authUser = Auth::user();
        activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' update permission');

        // Return response
        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission successfully updated.');
    }

    public function destroy($id)
    {
        try {
            // Find the permission by ID
            $permission = Permission::findOrFail($id);

            // Delete the permission
            $permission->delete();

            $authUser = Auth::user();
            activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' delete permission');

            // Return response
            return response()->json([
                'success' => 'Permission successfully deleted.',
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => 'An error occurred while deleting permission!',
            ], 200);
        }
    }
}

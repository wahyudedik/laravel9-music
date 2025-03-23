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

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $authUser = Auth::user();
        activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' visited add user form');

        $role = Role::orderBy('name', 'desc')->get();
        $data = [
            'mode' => 'Add New',
            'roles' => $role
        ];
        return view('admin.users.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required',

            // Optional: Validate only if filled
            'phone' => 'nullable|numeric',
            'region' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ], [
            // Messages for name
            'name.required' => 'The fullname field is required.',
            'name.string' => 'The fullname must be a string.',
            'name.max' => 'The fullname may not be greater than 255 characters.',

            // Messages for username
            'username.required' => 'The username field is required.',
            'username.string' => 'The username must be a string.',
            'username.max' => 'The username may not be greater than 50 characters.',
            'username.unique' => 'This username is already taken. Please choose another.',

            // Messages for email
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered. Please use a different one.',

            // Messages for password
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.confirmed' => 'The password confirmation does not match.',

            // Messages for password confirmation
            'password_confirmation.required' => 'The password confirmation field is required.',

            // Messages for role
            'role.required' => 'The role field is required.',

            // Messages for phone (if filled)
            'phone.digits_between' => 'The phone number must be between 10 and 15 digits.',

            // Messages for region (if filled)
            'region.string' => 'The region must be a string.',
            'region.max' => 'The region may not be greater than 100 characters.',

            // Messages for city (if filled)
            'city.string' => 'The city must be a string.',
            'city.max' => 'The city may not be greater than 100 characters.',
        ]);

        $verificationToken = Str::random(64);

        $user = User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone ? preg_replace('/^0/', '62', $request->phone) : null,
            'country' => 'Indonesia',
            'region' => $request->region ?? null,
            'city' => $request->city ?? null,
            'profile_picture' => null,
            'followers' => 0,
            'following' => 0,
            'email_verified_at' => null, // Email belum diverifikasi
            'email_verification_token' => $verificationToken, // Simpan token di database
            'email_verification_sent_at' => now(),
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user->assignRole($request->role);

        // Buat URL verifikasi
        $verificationUrl = url('/verify-email?token=' . $verificationToken . '&email=' . $user->email);

        try {
            // Kirim email verifikasi
            Mail::to($user->email)->send(new VerifyEmailMail($user, $verificationUrl));

            session(['email' => $user->email]);

            $authUser = Auth::user();
            activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' create user');

            // Redirect ke halaman pemberitahuan
            return redirect()->route('admin.user.index')->with('success', 'Successfully added user');
        } catch (\Exception $e) {

            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $authUser = Auth::user();
        activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' visited edit user form');


        $user = User::findOrFail($id);

        $role = Role::orderBy('name', 'desc')->get();
        $data = [
            'mode' => 'Edit',
            'roles' => $role,
            'user' => $user
        ];
        return view('admin.users.form', $data);

    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => $request->password ? 'required' : '',
            'role' => 'required',

            // Optional: Validate only if filled
            'phone' => 'nullable|numeric',
            'region' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ], [
            // Messages for name
            'name.required' => 'The fullname field is required.',
            'name.string' => 'The fullname must be a string.',
            'name.max' => 'The fullname may not be greater than 255 characters.',

            // Messages for username
            'username.required' => 'The username field is required.',
            'username.string' => 'The username must be a string.',
            'username.max' => 'The username may not be greater than 50 characters.',
            'username.unique' => 'This username is already taken. Please choose another.',

            // Messages for email
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered. Please use a different one.',

            // Messages for password
            'password.min' => 'The password must be at least 6 characters.',
            'password.confirmed' => 'The password confirmation does not match.',

            // Messages for password confirmation
            'password_confirmation.required' => 'The password confirmation field is required.',

            // Messages for role
            'role.required' => 'The role field is required.',

            // Messages for phone (if filled)
            'phone.numeric' => 'The phone number must be a valid number.',

            // Messages for region (if filled)
            'region.string' => 'The region must be a string.',
            'region.max' => 'The region may not be greater than 100 characters.',

            // Messages for city (if filled)
            'city.string' => 'The city must be a string.',
            'city.max' => 'The city may not be greater than 100 characters.',
        ]);

        // Update user data
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'phone' => $request->phone ? preg_replace('/^0/', '62', $request->phone) : null,
            'region' => $request->region ?? null,
            'city' => $request->city ?? null,
            'ip_address' => $request->ip(),
            'updated_at' => now(),
        ]);

        // Update role
        if ($request->role) {
            $user->syncRoles([$request->role]);
        }

        $authUser = Auth::user();
        activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' update user');

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            $authUser = Auth::user();
            activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' delete user');

            return response()->json([
                'success' => 'User successfully deleted!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while deleting the user!',
            ], 500);
        }
    }
}

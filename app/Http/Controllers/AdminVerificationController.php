<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminVerificationController extends Controller
{
    public function index()
    {
        // Change from get() to paginate()
        $verifications = Verification::with('user')->paginate(10); // 10 items per page

        // Get users for the create verification form
        $users = User::all();

        return view('admin.verification', compact('verifications', 'users'));
    }

    public function approve(Request $request, $id)
    {
        $verification = Verification::findOrFail($id);
        $verification->status = 'approved';
        $verification->save();

        // Cari user berdasarkan user_id di verification
        $user = User::find($verification->user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // Mapping type di verification ke name di roles
        $roleMap = [
            'composer' => 'Composer',
            'artist' => 'Artist',
            'cover' => 'Cover Creator',
        ];

        // Ambil role berdasarkan mapping
        $roleName = $roleMap[$verification->type] ?? null;

        if (!$roleName) {
            return redirect()->back()->with('error', 'Role tidak ditemukan untuk tipe verifikasi ini.');
        }

        // Cari role di database berdasarkan name
        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            return redirect()->back()->with('error', 'Role tidak ditemukan.');
        }

        // Update role di model_has_roles
        DB::table('model_has_roles')
            ->where('model_uuid', $user->id) // Menggunakan model_uuid
            ->where('model_type', User::class)
            ->update(['role_id' => $role->id]);

        return redirect()->route('admin.verifications.index')->with('success', 'Verifikasi disetujui.');
    }


    public function reject(Request $request, $id)
    {
        $verification = Verification::findOrFail($id);
        $verification->status = 'rejected';
        $verification->save();

        return redirect()->route('admin.verifications.index')->with('success', 'Verifikasi ditolak.');
    }

    // Add these methods for CRUD functionality

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:artist,composer,cover',
            'document_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'document_npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string|max:500',
        ]);

        $verification = new Verification();
        $verification->id = Str::uuid();
        $verification->user_id = $request->user_id;
        $verification->type = $request->type;
        $verification->status = $request->status;
        $verification->notes = $request->notes;

        if ($request->hasFile('document_ktp')) {
            $verification->document_ktp = $request->file('document_ktp')->store('verifications/ktp', 'public');
        }

        if ($request->hasFile('document_npwp')) {
            $verification->document_npwp = $request->file('document_npwp')->store('verifications/npwp', 'public');
        }

        $verification->save();

        return redirect()->route('admin.verifications.index')->with('success', 'Verification request created successfully.');
    }

    public function update(Request $request, $id)
    {
        $verification = Verification::findOrFail($id);

        $request->validate([
            'type' => 'required|in:artist,composer,cover',
            'document_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'document_npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string|max:500',
        ]);

        $verification->type = $request->type;
        $verification->status = $request->status;
        $verification->notes = $request->notes;

        if ($request->hasFile('document_ktp')) {
            // Delete old file if exists
            if ($verification->document_ktp) {
                Storage::disk('public')->delete($verification->document_ktp);
            }
            $verification->document_ktp = $request->file('document_ktp')->store('verifications/ktp', 'public');
        }

        if ($request->hasFile('document_npwp')) {
            // Delete old file if exists
            if ($verification->document_npwp) {
                Storage::disk('public')->delete($verification->document_npwp);
            }
            $verification->document_npwp = $request->file('document_npwp')->store('verifications/npwp', 'public');
        }

        $verification->save();

        return redirect()->route('admin.verifications.index')->with('success', 'Verification request updated successfully.');
    }

    public function destroy($id)
    {
        $verification = Verification::findOrFail($id);

        // Delete associated files
        if ($verification->document_ktp) {
            Storage::disk('public')->delete($verification->document_ktp);
        }

        if ($verification->document_npwp) {
            Storage::disk('public')->delete($verification->document_npwp);
        }

        $verification->delete();

        return redirect()->route('admin.verifications.index')->with('success', 'Verification request deleted successfully.');
    }

    public function getDetails($id)
    {
        $verification = Verification::with('user')->findOrFail($id);
        return response()->json($verification);
    }
}

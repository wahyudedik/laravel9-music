<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminVerificationController extends Controller
{
    public function index()
    {
        $verifications = Verification::with('user')->get();
        return view('admin.verification', compact('verifications'));
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
}

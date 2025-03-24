<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserVerificationController extends Controller
{
    public function showVerificationForm()
    {
        // Cek apakah user sudah mengajukan verifikasi
        $existingVerification = Verification::where('user_id', auth()->id())->latest()->first();

        return view('users.verification', compact('existingVerification'));
    }

    public function submitVerification(Request $request)
    {
        // Cek apakah user sudah memiliki pengajuan yang pending
        $pendingVerification = Verification::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        if ($pendingVerification) {
            return redirect()->back()->with('error', 'Anda sudah memiliki pengajuan verifikasi yang sedang diproses.');
        }

        $rules = [
            'type' => 'required|in:composer,artist,cover',
            'document_ktp' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'document_npwp' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ];

        // Tambahkan validasi bersyarat untuk document_npwp jika type adalah composer
        if ($request->input('type') === 'composer') {
            $rules['document_npwp'] = 'required|file|mimes:pdf,jpeg,png,jpg|max:2048';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ktpPath = $request->file('document_ktp')->store('uploads/verifications', 'public');

        $npwpPath = null;
        if ($request->hasFile('document_npwp')) {
            $npwpPath = $request->file('document_npwp')->store('uploads/verifications', 'public');
        }

        $userId = auth()->id();

        Verification::create([
            'id' => Str::uuid(),
            'user_id' => $userId,
            'type' => $request->type,
            'document_ktp' => $ktpPath,
            'document_npwp' => $npwpPath,
            'status' => 'pending',
        ]);

        return redirect()->route('verification.status')->with('success', 'Verifikasi berhasil diajukan! Silahkan tunggu persetujuan dari admin.');
    }

    public function submitArtistVerification(Request $request)
    {
        // Cek apakah user sudah memiliki pengajuan yang pending
        $pendingVerification = Verification::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        if ($pendingVerification) {
            return redirect()->back()->with('error', 'Anda sudah memiliki pengajuan verifikasi yang sedang diproses.');
        }

        $rules = [
            'type' => 'required|in:artist',
            'status' => 'required|in:pending',
            'document_ktp' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ktpPath = $request->file('document_ktp')->store('uploads/verifications', 'public');

        $userId = auth()->id();

        Verification::create([
            'id' => Str::uuid(),
            'user_id' => $userId,
            'type' => $request->type,
            'document_ktp' => $ktpPath,
            'document_npwp' => null,
            'status' => 'pending',
        ]);

        return redirect()->route('verification.status')->with('success', 'Verifikasi berhasil diajukan! Silahkan tunggu persetujuan dari admin.');
    }

    public function submitComposerVerification(Request $request)
    {
        // Cek apakah user sudah memiliki pengajuan yang pending
        $pendingVerification = Verification::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        if ($pendingVerification) {
            return redirect()->back()->with('error', 'Anda sudah memiliki pengajuan verifikasi yang sedang diproses.');
        }

        $rules = [
            'type' => 'required|in:composer',
            'document_ktp' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'document_npwp' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ktpPath = $request->file('document_ktp')->store('uploads/verifications', 'public');
        $npwpPath = $request->file('document_npwp')->store('uploads/verifications', 'public');

        $userId = auth()->id();

        Verification::create([
            'id' => Str::uuid(),
            'user_id' => $userId,
            'type' => $request->type,
            'document_ktp' => $ktpPath,
            'document_npwp' => $npwpPath,
            'status' => 'pending',
        ]);

        return redirect()->route('verification.status')->with('success', 'Verifikasi berhasil diajukan! Silahkan tunggu persetujuan dari admin.');
    }

    public function checkStatus()
    {
        $verification = Verification::where('user_id', auth()->id())->latest()->first();

        return view('users.verification_status', compact('verification'));
    }
}

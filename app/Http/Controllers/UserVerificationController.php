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
        return view('users.verification');
    }

    public function submitVerification(Request $request)
    {
        // Validasi
        // $validator = Validator::make($request->all(), [
        //     'type' => 'required|in:composer,artist,cover',
        //     'document_ktp' => 'required|image|mimes:pdf,jpeg,png,jpg|max:2048',
        //     'document_npwp' => 'image|mimes:pdf,jpeg,png,jpg|max:2048',
        // ]);

        $rules = [
            'type' => 'required|in:composer,artist,cover',
            'document_ktp' => 'required|image|mimes:pdf,jpeg,png,jpg|max:2048',
            'document_npwp' => 'image|mimes:pdf,jpeg,png,jpg|max:2048',
        ];

        // Tambahkan validasi bersyarat untuk document_npwp jika type adalah composer
        if ($request->input('type') === 'composer') {
            $rules['document_npwp'] = 'required|image|mimes:pdf,jpeg,png,jpg|max:2048';
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

        return view('users.verification', ['message' => 'Verifikasi berhasil diajukan!']);
    }
}

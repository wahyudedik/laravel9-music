<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use App\Services\Admin\SongServices;

class AdminClaimController extends Controller
{
    /**
     * Display a listing of the claims.
     */
    public function index(Request $request)
    {
        $query = Claim::with(['user', 'song']);

        // Filter by status if provided
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                    ->orWhereHas('song', function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                            // ->orWhere('artist', 'like', "%{$search}%"); 
                    });
            });
        }

        $claims = $query->latest()->paginate(10);

        return view('admin.claims.index', compact('claims'));
    }

    /**
     * Show the form for creating a new claim.
     */
    public function create()
    {
        $authUser = Auth::user();
        activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' visited create claim form');

        $users = User::all();
        $songs = Song::all();

        return view('admin.claims.create', compact('users', 'songs'));
    }

    /**
     * Store a newly created claim in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'song_id' => 'required|exists:songs,id',
            'notes' => 'nullable|string|max:1000',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('claims', 'public');
        }

        Claim::create([
            'id' => Str::uuid(), // Generate UUID for the claim
            'user_id' => $request->user_id,
            'song_id' => $request->song_id,
            'status' => 'pending', // Default status for new claims
            'notes' => $request->notes ?? null,
            'document' => $documentPath,
        ]);

        $authUser = Auth::user();
        activity('claim')
            ->withProperties(['ip' => request()->ip()])
            ->log('Claim Created');
        activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' create claim');

        return redirect()->route('admin.claims.index')->with('success', 'Claim created successfully.');
    }

    /**
     * Display the specified claim.
     */
    public function show(Claim $claim)
    {
        $claim->load(['user', 'song']);

        return view('admin.claims.show', compact('claim'));
    }

    /**
     * Show the form for editing the specified claim.
     */
    public function edit(Claim $claim)
    {

        $authUser = Auth::user();
        activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' visited edit claim form');

        return view('admin.claims.edit', compact('claim'));
    }

    /**
     * Update the specified claim in storage.
     */
    public function update(Request $request, Claim $claim)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'song_id' => 'required|exists:songs,id',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string|max:1000',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        // Handle document upload
        $documentPath = $claim->document;
        if ($request->hasFile('document')) {
            // Delete old document if it exists
            if (!empty($documentPath) && Storage::disk('public')->exists($documentPath)) {
                Storage::disk('public')->delete($documentPath);
            }

            // Store new document
            $documentPath = $request->file('document')->store('claims', 'public');
        }

        $claim->update([
            'user_id' => $request->user_id,
            'song_id' => $request->song_id,
            'status' => $request->status,
            'notes' => $request->notes ?? null,
            'document' => $documentPath,
        ]);

        $authUser = Auth::user();
        activity('claim')
            ->withProperties(['ip' => request()->ip()])
            ->log('Claim Edited');
        activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' update claim');

        return redirect()->route('admin.claims.index')->with('success', 'Claim updated successfully.');
    }

    /**
     * Remove the specified claim from storage.
     */
    public function destroy($id)
    {

        try {

            $claim = Claim::find($id);

            if (!$claim) {
                return response()->json(['error' => 'Claim not found.'], 404);
            }

            // Delete document if exists
            if ($claim->document && Storage::disk('public')->exists($claim->document)) {
                Storage::disk('public')->delete($claim->document);
            }

            $claim->delete();

            $authUser = Auth::user();
            activity('claim')
                ->withProperties(['ip' => request()->ip()])
                ->log('Claim Deleted');
            activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' deleted claim');

            return redirect()->route('admin.claims.index')->with('success', 'Claim successfully deleted!');
        } catch (\Exception $e) {

            return redirect()->route('admin.claims.index')->with('error', 'Claim failed to delete!');
        }
    }

    /**
     * Unclaim a song (change status to rejected)
     */
    public function unclaimSong(Claim $claim)
    {
        // If the claim is approved, change it to rejected (unclaimed)
        if ($claim->status === 'approved') {
            $claim->update([
                'status' => 'rejected',
            ]);

            $authUser = Auth::user();
            activity('claim')
                ->withProperties(['ip' => request()->ip()])
                ->log('Claim Unclaimed');
            activity()->withProperties(['ip' => request()->ip()])->log($authUser->name . ' unclaimed song');

            return redirect()->route('admin.claims.index')->with('success', 'Song has been unclaimed successfully.');
        }

        return redirect()->route('admin.claims.index')->with('error', 'Only approved claims can be unclaimed.');
    }

    /**
     * Approve song claim
     */
    public function approve(Claim $claim)
    {
        // Check if the claim is already approved
        if ($claim->status === 'approved') {
            return redirect()->route('admin.claims.index')->with('info', 'This claim is already approved.');
        }

        // Update the claim status to approved
        $claim->update([
            'status' => 'approved',
        ]);

        // Log activity
        $authUser = Auth::user();
        activity('claim')
            ->withProperties(['ip' => request()->ip()])
            ->log("Claim Approved");
        activity()
            ->withProperties(['ip' => request()->ip()])
            ->log($authUser->name . ' approved a claim.');

        // Redirect with success message
        return redirect()->route('admin.claims.index')->with('success', 'Claim approved successfully.');
    }

    /**
     * Reject song claim
     */
    public function reject(Request $request, Claim $claim)
    {

        // Check if the claim is already rejected
        if ($claim->status === 'rejected') {
            return redirect()->route('admin.claims.index')->with('info', 'This claim is already rejected.');
        }

        // Update the claim status to rejected
        $claim->update([
            'status' => 'rejected',
        ]);

        // Log activity
        $authUser = Auth::user();
        activity('claim')
            ->withProperties(['ip' => request()->ip()])
            ->log("Claim Rejected");
        activity()
            ->withProperties(['ip' => request()->ip()])
            ->log($authUser->name . ' rejected a claim.');

        // Redirect with success message
        return redirect()->route('admin.claims.index')->with('success', 'Claim rejected successfully.');
    }
}

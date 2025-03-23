<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('song', function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('artist', 'like', "%{$search}%");
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
            'document' => $documentPath,
        ]);
        
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
        $users = User::all();
        $songs = Song::all();
        
        return view('admin.claims.edit', compact('claim', 'users', 'songs'));
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
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);
        
        $documentPath = $claim->document;
        if ($request->hasFile('document')) {
            // Delete old document if exists
            if ($documentPath && Storage::disk('public')->exists($documentPath)) {
                Storage::disk('public')->delete($documentPath);
            }
            
            $documentPath = $request->file('document')->store('claims', 'public');
        }
        
        $claim->update([
            'user_id' => $request->user_id,
            'song_id' => $request->song_id,
            'status' => $request->status,
            'document' => $documentPath,
        ]);
        
        return redirect()->route('admin.claims.index')->with('success', 'Claim updated successfully.');
    }

    /**
     * Remove the specified claim from storage.
     */
    public function destroy(Claim $claim)
    {
        // Delete document if exists
        if ($claim->document && Storage::disk('public')->exists($claim->document)) {
            Storage::disk('public')->delete($claim->document);
        }
        
        $claim->delete();
        
        return redirect()->route('admin.claims.index')->with('success', 'Claim deleted successfully.');
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
            
            return redirect()->route('admin.claims.index')->with('success', 'Song has been unclaimed successfully.');
        }
        
        return redirect()->route('admin.claims.index')->with('error', 'Only approved claims can be unclaimed.');
    }
}

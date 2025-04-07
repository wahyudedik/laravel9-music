<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function destroy($id)
    {
        $activity = ActivityLog::findOrFail($id);
        $activity->delete();

        return redirect()->back()->with('success', 'Aktivity Log berhasil dihapus.');
    }
}

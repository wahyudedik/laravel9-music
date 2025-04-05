<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity as SpatieActivity;
use App\Models\User;

class ActivityLog extends SpatieActivity
{
    // Relasi ke user berdasarkan subject_id
    public function subjectUser()
    {
        return $this->belongsTo(User::class, 'subject_id');
    }
}

<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;

class ActivityLogger
{
    /**
     * Record a new activity log entry.
     */
    public static function log(
        string $action,
        ?Model $subject = null,
        ?string $description = null,
        ?array $metadata = null,
        ?int $actorId = null
    ): ActivityLog {
        $user = auth()->user();

        return ActivityLog::create([
            'actor_id' => $actorId ?? $user?->id,
            'action' => $action,
            'subject_type' => $subject ? get_class($subject) : null,
            'subject_id' => $subject?->getKey(),
            'description' => $description,
            'metadata' => $metadata,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
        ]);
    }
}

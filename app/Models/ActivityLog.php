<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActivityLog extends Model
{
    protected $fillable = [
        'log_name',
        'description',
        'subject_type',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties',
        'event',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    /**
     * Get the subject of the activity
     */
    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the causer of the activity
     */
    public function causer(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope for form-related activities
     */
    public function scopeFormActivities($query)
    {
        return $query->where('log_name', 'form');
    }

    /**
     * Scope for submission-related activities
     */
    public function scopeSubmissionActivities($query)
    {
        return $query->where('log_name', 'submission');
    }

    /**
     * Scope for field-related activities
     */
    public function scopeFieldActivities($query)
    {
        return $query->where('log_name', 'field');
    }

    /**
     * Get formatted time ago
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Get activity icon based on event type
     */
    public function getIconAttribute()
    {
        return match($this->event) {
            'created' => 'plus',
            'updated' => 'edit',
            'deleted' => 'trash',
            'submitted' => 'send',
            'approved' => 'check',
            'rejected' => 'x',
            'exported' => 'download',
            default => 'activity'
        };
    }

    /**
     * Get activity color based on event type
     */
    public function getColorAttribute()
    {
        return match($this->event) {
            'created' => 'green',
            'updated' => 'blue',
            'deleted' => 'red',
            'submitted' => 'purple',
            'approved' => 'green',
            'rejected' => 'red',
            'exported' => 'indigo',
            default => 'gray'
        };
    }
}
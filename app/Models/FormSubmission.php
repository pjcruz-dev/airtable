<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class FormSubmission extends Model
{
    protected $fillable = [
        'form_id',
        'submission_id',
        'data',
        'submitted_by',
        'status',
        'notes',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($submission) {
            if (empty($submission->submission_id)) {
                $submission->submission_id = Str::uuid();
            }
        });
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function getFieldValue($fieldName)
    {
        return $this->data[$fieldName] ?? null;
    }

    public function setFieldValue($fieldName, $value)
    {
        $data = $this->data ?? [];
        $data[$fieldName] = $value;
        $this->data = $data;
    }
}

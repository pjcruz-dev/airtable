<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormField extends Model
{
    protected $fillable = [
        'form_id',
        'name',
        'label',
        'type',
        'description',
        'is_required',
        'options',
        'validation_rules',
        'sort_order',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'options' => 'json',
        'validation_rules' => 'json',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function getFieldTypeAttribute()
    {
        return $this->type;
    }

    // Removed getValidationRulesAttribute to avoid syntax issues during creation
}

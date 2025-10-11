<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Form extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug',
        'is_active',
        'published',
        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published' => 'boolean',
        'settings' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($form) {
            if (empty($form->slug)) {
                $form->slug = Str::slug($form->name);
            }
        });
    }

    public function fields(): HasMany
    {
        return $this->hasMany(FormField::class)->orderBy('sort_order');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormTemplate extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'icon',
        'fields_data',
        'is_active',
    ];

    protected $casts = [
        'fields_data' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get templates by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get active templates
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Create a form from this template
     */
    public function createForm($name, $description = null)
    {
        $form = Form::create([
            'name' => $name,
            'description' => $description ?: $this->description,
            'slug' => \Illuminate\Support\Str::slug($name),
        ]);

        // Create fields from template data
        foreach ($this->fields_data as $index => $fieldData) {
            $form->fields()->create([
                'name' => $fieldData['name'],
                'label' => $fieldData['label'],
                'type' => $fieldData['type'],
                'description' => $fieldData['description'] ?? null,
                'is_required' => $fieldData['is_required'] ?? false,
                'options' => $fieldData['options'] ?? null,
                'validation_rules' => $fieldData['validation_rules'] ?? null,
                'sort_order' => $index,
            ]);
        }

        return $form;
    }
}
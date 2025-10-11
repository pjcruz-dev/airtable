<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{
    /**
     * Store a newly created field
     */
    public function store(Request $request, Form $form)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'label' => 'required|string|max:255',
                    'type' => 'required|string|in:text,email,number,select,multiselect,textarea,checkbox,single-checkbox,radio,date,file',
                'description' => 'nullable|string',
                'is_required' => 'nullable|in:0,1,true,false,on,off',
                'options' => 'nullable|string',
                'validation_rules' => 'nullable|array',
            ]);

            // Parse options if provided
            $options = null;
            if ($request->options) {
                $options = json_decode($request->options, true);
            }

            $field = $form->fields()->create([
                'name' => $request->name,
                'label' => $request->label,
                'type' => $request->type,
                'description' => $request->description,
                'is_required' => filter_var($request->is_required, FILTER_VALIDATE_BOOLEAN),
                'options' => $options,
                'validation_rules' => $request->validation_rules ?: null,
                'sort_order' => $form->fields()->count(),
            ]);

            return response()->json($field);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while creating the field: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified field
     */
    public function update(Request $request, Form $form, FormField $field)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:255',
                    'type' => 'required|string|in:text,email,number,select,multiselect,textarea,checkbox,single-checkbox,radio,date,file',
            'description' => 'nullable|string',
            'is_required' => 'boolean',
            'options' => 'nullable|array',
            'validation_rules' => 'nullable|array',
        ]);

        $field->update([
            'name' => $request->name,
            'label' => $request->label,
            'type' => $request->type,
            'description' => $request->description,
            'is_required' => $request->boolean('is_required'),
            'options' => $request->options,
            'validation_rules' => $request->validation_rules,
        ]);

        return response()->json($field);
    }

    /**
     * Remove the specified field
     */
    public function destroy(Form $form, FormField $field)
    {
        $field->delete();
        
        // Reorder remaining fields
        $form->fields()->orderBy('sort_order')->get()->each(function ($field, $index) {
            $field->update(['sort_order' => $index]);
        });

        return response()->json(['success' => true]);
    }

    /**
     * Update field order
     */
    public function updateOrder(Request $request, Form $form)
    {
        $request->validate([
            'fields' => 'required|array',
            'fields.*.id' => 'required|exists:form_fields,id',
            'fields.*.sort_order' => 'required|integer',
        ]);

        foreach ($request->fields as $fieldData) {
            $field = $form->fields()->find($fieldData['id']);
            if ($field) {
                $field->update(['sort_order' => $fieldData['sort_order']]);
            }
        }

        return response()->json(['success' => true]);
    }
}

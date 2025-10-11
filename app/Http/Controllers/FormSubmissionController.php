<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormSubmissionController extends Controller
{
    /**
     * Display a listing of submissions for a form
     */
    public function index(Form $form)
    {
        $submissions = $form->submissions()->latest()->paginate(20);
        return view('forms.submissions', compact('form', 'submissions'));
    }

    /**
     * Store a newly created submission
     */
    public function store(Request $request, Form $form)
    {
        if (!$form->is_active) {
            return response()->json(['error' => 'Form is not active'], 400);
        }

        // Build validation rules from form fields
        $rules = [];
        foreach ($form->fields as $field) {
            $fieldRules = $field->validation_rules ?? [];
            
            if ($field->is_required) {
                if ($field->type === 'checkbox' && $field->options) {
                    // For checkbox groups, require at least one selection
                    $fieldRules[] = 'required';
                    $fieldRules[] = 'array';
                    $fieldRules[] = 'min:1';
                } elseif ($field->type === 'file') {
                    // For file uploads
                    $fieldRules[] = 'required';
                    $fieldRules[] = 'file';
                    $fieldRules[] = 'max:10240'; // 10MB max
                    $fieldRules[] = 'mimes:pdf,doc,docx,jpg,jpeg,png,gif,txt';
                } else {
                    $fieldRules[] = 'required';
                }
            }
            
            $rules[$field->name] = $fieldRules;
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle file uploads
        $data = $request->except(['_token', 'submitted_by']);
        
        foreach ($form->fields as $field) {
            if ($field->type === 'file' && $request->hasFile($field->name)) {
                $file = $request->file($field->name);
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('form-submissions', $filename, 'public');
                $data[$field->name] = $path;
            }
        }

        $submission = $form->submissions()->create([
            'data' => $data,
            'submitted_by' => $request->submitted_by,
        ]);

        return response()->json([
            'success' => true,
            'submission_id' => $submission->submission_id,
            'message' => 'Form submitted successfully!'
        ]);
    }

    /**
     * Display the specified submission
     */
    public function show(Form $form, FormSubmission $submission)
    {
        return view('forms.submission-detail', compact('form', 'submission'));
    }

    /**
     * Update submission status
     */
    public function updateStatus(Request $request, Form $form, FormSubmission $submission)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string',
        ]);

        $submission->update([
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified submission
     */
    public function destroy(Form $form, FormSubmission $submission)
    {
        $submission->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Export submissions as CSV
     */
    public function export(Form $form)
    {
        $submissions = $form->submissions()->latest()->get();
        
        $filename = $form->slug . '_submissions_' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($form, $submissions) {
            $file = fopen('php://output', 'w');
            
            // Write headers
            $headers = ['Submission ID', 'Submitted By', 'Status', 'Submitted At'];
            foreach ($form->fields as $field) {
                $headers[] = $field->label;
            }
            fputcsv($file, $headers);

            // Write data
            foreach ($submissions as $submission) {
                $row = [
                    $submission->submission_id,
                    $submission->submitted_by,
                    $submission->status,
                    $submission->created_at->format('Y-m-d H:i:s'),
                ];
                
                foreach ($form->fields as $field) {
                    $row[] = $submission->getFieldValue($field->name);
                }
                
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

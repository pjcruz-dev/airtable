<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormTemplate;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class FormTemplateController extends Controller
{
    /**
     * Display available form templates
     */
    public function index()
    {
        $templates = FormTemplate::active()
            ->orderBy('category')
            ->orderBy('name')
            ->get()
            ->groupBy('category');

        return view('form-templates.index', compact('templates'));
    }

    /**
     * Create a form from a template
     */
    public function createForm(Request $request, FormTemplate $template)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $form = $template->createForm($request->name, $request->description);

        // Log the form creation from template
        ActivityLogger::logFormCreated($form, null, $request);

        return redirect()
            ->route('forms.builder', $form)
            ->with('success', "Form '{$form->name}' created successfully from template!");
    }

    /**
     * Preview a template
     */
    public function preview(FormTemplate $template)
    {
        return view('form-templates.preview', compact('template'));
    }
}
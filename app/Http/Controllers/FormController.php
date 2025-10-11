<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Form::with('fields')->latest()->paginate(10);
        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $form = Form::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name),
        ]);

        // Log the form creation
        ActivityLogger::logFormCreated($form, null, $request);

        return redirect()->route('forms.builder', $form)->with('success', 'Form created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        $form->load('fields', 'submissions');
        return view('forms.show', compact('form'));
    }

    /**
     * Show the form builder
     */
    public function builder(Form $form)
    {
        $form->load('fields');
        return view('forms.builder', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        return view('forms.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $form->update($request->all());

        return redirect()->route('forms.index')->with('success', 'Form updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('forms.index')->with('success', 'Form deleted successfully!');
    }

    /**
     * Show form for vendors to fill
     */
    public function vendorForm(Form $form)
    {
        if (!$form->is_active) {
            abort(404);
        }
        
        $form->load('fields');
        return view('forms.vendor-form', compact('form'));
    }
}

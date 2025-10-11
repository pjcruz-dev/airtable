<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\FormSubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('forms.index');
});

// Form Management Routes
Route::resource('forms', FormController::class);
Route::get('forms/{form}/builder', [FormController::class, 'builder'])->name('forms.builder');
Route::get('forms/{form}/vendor-form', [FormController::class, 'vendorForm'])->name('forms.vendor-form');

// Form Field Routes
Route::post('forms/{form}/fields', [FormFieldController::class, 'store'])->name('form-fields.store');
Route::put('forms/{form}/fields/{field}', [FormFieldController::class, 'update'])->name('form-fields.update');
Route::delete('forms/{form}/fields/{field}', [FormFieldController::class, 'destroy'])->name('form-fields.destroy');
Route::post('forms/{form}/fields/order', [FormFieldController::class, 'updateOrder'])->name('form-fields.order');

// Form Submission Routes
Route::get('forms/{form}/submissions', [FormSubmissionController::class, 'index'])->name('forms.submissions');
Route::post('forms/{form}/submissions', [FormSubmissionController::class, 'store'])->name('forms.submissions.store');
Route::get('forms/{form}/submissions/{submission}', [FormSubmissionController::class, 'show'])->name('forms.submissions.show');
Route::post('forms/{form}/submissions/{submission}/status', [FormSubmissionController::class, 'updateStatus'])->name('forms.submissions.status');
Route::delete('forms/{form}/submissions/{submission}', [FormSubmissionController::class, 'destroy'])->name('forms.submissions.destroy');
Route::get('forms/{form}/submissions/export', [FormSubmissionController::class, 'export'])->name('forms.submissions.export');

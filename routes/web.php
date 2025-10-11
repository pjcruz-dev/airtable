<?php

use App\Http\Controllers\ActivityLogController;
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
Route::get('forms/{form}/fields/{field}', [FormFieldController::class, 'show'])->name('form-fields.show');
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

// File Download Route
Route::get('download/{filename}', function($filename) {
    $path = storage_path('app/public/form-submissions/' . $filename);
    
    if (!file_exists($path)) {
        abort(404, 'File not found');
    }
    
    return response()->download($path);
})->name('file.download');

// Activity Log Routes
Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
Route::get('activity-logs/stats', [ActivityLogController::class, 'stats'])->name('activity-logs.stats');
Route::get('activity-logs/export', [ActivityLogController::class, 'export'])->name('activity-logs.export');
Route::get('forms/{form}/activity-logs', [ActivityLogController::class, 'form'])->name('forms.activity-logs');

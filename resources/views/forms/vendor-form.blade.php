@extends('layouts.app')

@section('title', $form->name)

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-900">{{ $form->name }}</h1>
        @if($form->description)
            <p class="mt-4 text-lg text-gray-600">{{ $form->description }}</p>
        @endif
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
        <form id="vendor-form" method="POST" action="{{ route('forms.submissions.store', $form) }}">
            @csrf
            
            <div class="space-y-6">
                @foreach($form->fields as $field)
                    <div class="field-group">
                        <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $field->label }}
                            @if($field->is_required)
                                <span class="text-red-500">*</span>
                            @endif
                        </label>
                        
                        @if($field->description)
                            <p class="text-sm text-gray-600 mb-3">{{ $field->description }}</p>
                        @endif

                        @if($field->type === 'text' || $field->type === 'email' || $field->type === 'number')
                            <input type="{{ $field->type }}" 
                                   id="{{ $field->name }}" 
                                   name="{{ $field->name }}"
                                   @if($field->is_required) required @endif
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error($field->name) border-red-500 @enderror"
                                   placeholder="Enter {{ strtolower($field->label) }}">
                        
                        @elseif($field->type === 'textarea')
                            <textarea id="{{ $field->name }}" 
                                      name="{{ $field->name }}"
                                      rows="4"
                                      @if($field->is_required) required @endif
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error($field->name) border-red-500 @enderror"
                                      placeholder="Enter {{ strtolower($field->label) }}"></textarea>
                        
                        @elseif($field->type === 'select')
                            <select id="{{ $field->name }}" 
                                    name="{{ $field->name }}"
                                    @if($field->is_required) required @endif
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error($field->name) border-red-500 @enderror">
                                <option value="">Select an option</option>
                                @if($field->options)
                                    @foreach($field->options as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                @endif
                            </select>
                        
                        @elseif($field->type === 'multiselect')
                            <select id="{{ $field->name }}" 
                                    name="{{ $field->name }}[]"
                                    multiple
                                    @if($field->is_required) required @endif
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error($field->name) border-red-500 @enderror">
                                @if($field->options)
                                    @foreach($field->options as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Hold Ctrl/Cmd to select multiple options</p>
                        
                        @elseif($field->type === 'checkbox')
                            <div class="space-y-2">
                                @if($field->options)
                                    @foreach($field->options as $option)
                                        <label class="flex items-center">
                                            <input type="checkbox" 
                                                   name="{{ $field->name }}[]" 
                                                   value="{{ $option }}"
                                                   class="mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded checkbox-group"
                                                   data-field-name="{{ $field->name }}"
                                                   data-required="{{ $field->is_required ? 'true' : 'false' }}">
                                            <span class="text-sm text-gray-700">{{ $option }}</span>
                                        </label>
                                    @endforeach
                                    @if($field->is_required)
                                        <input type="hidden" name="{{ $field->name }}_required" value="1">
                                    @endif
                                @else
                                    <label class="flex items-center">
                                        <input type="checkbox" 
                                               name="{{ $field->name }}" 
                                               value="1"
                                               @if($field->is_required) required @endif
                                               class="mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <span class="text-sm text-gray-700">{{ $field->label }}</span>
                                    </label>
                                @endif
                            </div>
                        
                        @elseif($field->type === 'single-checkbox')
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           name="{{ $field->name }}" 
                                           value="1"
                                           @if($field->is_required) required @endif
                                           class="mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <span class="text-sm text-gray-700">{{ $field->label }}</span>
                                </label>
                            </div>
                        
                        @elseif($field->type === 'radio')
                            <div class="space-y-2">
                                @if($field->options)
                                    @foreach($field->options as $option)
                                        <label class="flex items-center">
                                            <input type="radio" 
                                                   name="{{ $field->name }}" 
                                                   value="{{ $option }}"
                                                   @if($field->is_required) required @endif
                                                   class="mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <span class="text-sm text-gray-700">{{ $option }}</span>
                                        </label>
                                    @endforeach
                                @endif
                            </div>
                        
                        @elseif($field->type === 'date')
                            <input type="date" 
                                   id="{{ $field->name }}" 
                                   name="{{ $field->name }}"
                                   @if($field->is_required) required @endif
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error($field->name) border-red-500 @enderror">
                        
                        @elseif($field->type === 'file')
                            <div class="file-upload-container">
                                <input type="file" 
                                       id="{{ $field->name }}" 
                                       name="{{ $field->name }}"
                                       @if($field->is_required) required @endif
                                       accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.txt"
                                       class="hidden file-input"
                                       onchange="handleFileSelect(this)">
                                
                                <div class="file-drop-zone border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-400 transition-colors"
                                     onclick="document.getElementById('{{ $field->name }}').click()">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">
                                        <span class="font-medium text-blue-600 hover:text-blue-500">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX, JPG, PNG, GIF, TXT (Max 10MB)</p>
                                </div>
                                
                                <div id="{{ $field->name }}_preview" class="file-preview mt-3 hidden">
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-8 h-8 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900 file-name"></p>
                                            <p class="text-xs text-gray-500 file-size"></p>
                                        </div>
                                        <button type="button" onclick="removeFile('{{ $field->name }}')" class="text-red-500 hover:text-red-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @error($field->name)
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            </div>

            <!-- Vendor Information -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="mb-4">
                    <label for="submitted_by" class="block text-sm font-medium text-gray-700 mb-2">
                        Your Email Address
                    </label>
                    <input type="email" 
                           id="submitted_by" 
                           name="submitted_by"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="your.email@example.com">
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Submit Form
                </button>
            </div>
        </form>
    </div>

    <!-- Success Message -->
    <div id="success-message" class="hidden mt-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        <div class="flex">
            <div class="py-1">
                <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold">Form submitted successfully!</p>
                <p class="text-sm">Your submission ID is: <span id="submission-id"></span></p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('vendor-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            document.getElementById('submission-id').textContent = data.submission_id;
            document.getElementById('success-message').classList.remove('hidden');
            
            // Hide form
            document.getElementById('vendor-form').style.display = 'none';
            
            // Scroll to success message
            document.getElementById('success-message').scrollIntoView({ behavior: 'smooth' });
        } else {
            // Handle validation errors
            if (data.errors) {
                Object.keys(data.errors).forEach(field => {
                    const fieldElement = document.querySelector(`[name="${field}"]`);
                    if (fieldElement) {
                        fieldElement.classList.add('border-red-500');
                        
                        // Show error message
                        let errorDiv = fieldElement.parentNode.querySelector('.error-message');
                        if (!errorDiv) {
                            errorDiv = document.createElement('p');
                            errorDiv.className = 'mt-1 text-sm text-red-600 error-message';
                            fieldElement.parentNode.appendChild(errorDiv);
                        }
                        errorDiv.textContent = data.errors[field][0];
                    }
                });
            } else {
                alert('Error submitting form: ' + (data.message || 'Unknown error'));
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error submitting form. Please try again.');
    });
});

// Checkbox group validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('vendor-form');
    
    form.addEventListener('submit', function(e) {
        const checkboxGroups = document.querySelectorAll('.checkbox-group');
        let hasErrors = false;
        
        checkboxGroups.forEach(function(checkbox) {
            const fieldName = checkbox.getAttribute('data-field-name');
            const isRequired = checkbox.getAttribute('data-required') === 'true';
            
            if (isRequired) {
                const groupCheckboxes = document.querySelectorAll(`input[name="${fieldName}[]"]`);
                const checkedBoxes = document.querySelectorAll(`input[name="${fieldName}[]"]:checked`);
                
                if (checkedBoxes.length === 0) {
                    // Add error styling to all checkboxes in the group
                    groupCheckboxes.forEach(function(cb) {
                        cb.classList.add('border-red-500');
                        cb.style.borderColor = '#ef4444';
                    });
                    
                    // Show error message
                    const firstCheckbox = groupCheckboxes[0];
                    let errorDiv = firstCheckbox.closest('.space-y-2').querySelector('.checkbox-error');
                    if (!errorDiv) {
                        errorDiv = document.createElement('p');
                        errorDiv.className = 'mt-1 text-sm text-red-600 checkbox-error';
                        firstCheckbox.closest('.space-y-2').appendChild(errorDiv);
                    }
                    errorDiv.textContent = 'Please select at least one option.';
                    
                    hasErrors = true;
                } else {
                    // Remove error styling
                    groupCheckboxes.forEach(function(cb) {
                        cb.classList.remove('border-red-500');
                        cb.style.borderColor = '';
                    });
                    
                    // Remove error message
                    const errorDiv = firstCheckbox.closest('.space-y-2').querySelector('.checkbox-error');
                    if (errorDiv) {
                        errorDiv.remove();
                    }
                }
            }
        });
        
        if (hasErrors) {
            e.preventDefault();
            return false;
        }
    });
    
    // Clear errors when user selects a checkbox
    checkboxGroups.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const fieldName = this.getAttribute('data-field-name');
            const groupCheckboxes = document.querySelectorAll(`input[name="${fieldName}[]"]`);
            const checkedBoxes = document.querySelectorAll(`input[name="${fieldName}[]"]:checked`);
            
            if (checkedBoxes.length > 0) {
                // Remove error styling
                groupCheckboxes.forEach(function(cb) {
                    cb.classList.remove('border-red-500');
                    cb.style.borderColor = '';
                });
                
                // Remove error message
                const errorDiv = this.closest('.space-y-2').querySelector('.checkbox-error');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }
        });
    });
});

// File upload handling
function handleFileSelect(input) {
    const file = input.files[0];
    if (!file) return;
    
    // Check file size (10MB limit)
    if (file.size > 10 * 1024 * 1024) {
        alert('File size must be less than 10MB');
        input.value = '';
        return;
    }
    
    // Check file type
    const allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'gif', 'txt'];
    const fileExtension = file.name.split('.').pop().toLowerCase();
    
    if (!allowedTypes.includes(fileExtension)) {
        alert('File type not allowed. Please upload PDF, DOC, DOCX, JPG, PNG, GIF, or TXT files.');
        input.value = '';
        return;
    }
    
    // Show file preview
    const preview = document.getElementById(input.name + '_preview');
    const fileName = preview.querySelector('.file-name');
    const fileSize = preview.querySelector('.file-size');
    
    fileName.textContent = file.name;
    fileSize.textContent = formatFileSize(file.size);
    preview.classList.remove('hidden');
}

function removeFile(fieldName) {
    const input = document.getElementById(fieldName);
    const preview = document.getElementById(fieldName + '_preview');
    
    input.value = '';
    preview.classList.add('hidden');
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Drag and drop functionality
document.addEventListener('DOMContentLoaded', function() {
    const dropZones = document.querySelectorAll('.file-drop-zone');
    
    dropZones.forEach(zone => {
        zone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('border-blue-400', 'bg-blue-50');
        });
        
        zone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-400', 'bg-blue-50');
        });
        
        zone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-400', 'bg-blue-50');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const input = this.parentNode.querySelector('.file-input');
                input.files = files;
                handleFileSelect(input);
            }
        });
    });
});
</script>
@endpush

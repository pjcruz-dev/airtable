@extends('layouts.app')

@section('title', 'Form Builder - ' . $form->name)

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <div class="w-80 bg-white border-r border-gray-200 p-6 overflow-y-auto">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Form Fields</h2>
            <p class="text-sm text-gray-600">Drag fields to the form area</p>
        </div>

        <div class="space-y-3">
            <div class="field-template" data-type="text">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 cursor-move">
                    <div class="flex items-center">
                        <div class="text-blue-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-blue-900">Text Input</div>
                            <div class="text-sm text-blue-700">Single line text</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-template" data-type="email">
                <div class="bg-green-50 border border-green-200 rounded-lg p-3 cursor-move">
                    <div class="flex items-center">
                        <div class="text-green-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-green-900">Email</div>
                            <div class="text-sm text-green-700">Email address</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-template" data-type="number">
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 cursor-move">
                    <div class="flex items-center">
                        <div class="text-purple-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-purple-900">Number</div>
                            <div class="text-sm text-purple-700">Numeric input</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-template" data-type="textarea">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 cursor-move">
                    <div class="flex items-center">
                        <div class="text-yellow-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-yellow-900">Textarea</div>
                            <div class="text-sm text-yellow-700">Multi-line text</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-template" data-type="select">
                <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-3 cursor-move">
                    <div class="flex items-center">
                        <div class="text-indigo-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-indigo-900">Select</div>
                            <div class="text-sm text-indigo-700">Dropdown options</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-template" data-type="multiselect">
                <div class="bg-cyan-50 border border-cyan-200 rounded-lg p-3 cursor-move">
                    <div class="flex items-center">
                        <div class="text-cyan-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-cyan-900">Multi-Select</div>
                            <div class="text-sm text-cyan-700">Multiple dropdown selections</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-template" data-type="checkbox">
                <div class="bg-pink-50 border border-pink-200 rounded-lg p-3 cursor-move">
                    <div class="flex items-center">
                        <div class="text-pink-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-pink-900">Checkbox Group</div>
                            <div class="text-sm text-pink-700">Multiple choice checkboxes</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-template" data-type="single-checkbox">
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-3 cursor-move">
                    <div class="flex items-center">
                        <div class="text-orange-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-orange-900">Single Checkbox</div>
                            <div class="text-sm text-orange-700">Single yes/no checkbox</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-template" data-type="date">
                <div class="bg-teal-50 border border-teal-200 rounded-lg p-3 cursor-move">
                    <div class="flex items-center">
                        <div class="text-teal-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-teal-900">Date</div>
                            <div class="text-sm text-teal-700">Date picker</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-template" data-type="file">
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 cursor-move">
                    <div class="flex items-center">
                        <div class="text-purple-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-purple-900">File Upload</div>
                            <div class="text-sm text-purple-700">Document/Image upload</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <div class="bg-white border-b border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $form->name }}</h1>
                    @if($form->description)
                        <p class="text-gray-600 mt-1">{{ $form->description }}</p>
                    @endif
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('forms.vendor-form', $form) }}" target="_blank" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Preview
                    </a>
                    <a href="{{ route('forms.submissions', $form) }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        View Data
                    </a>
                    <a href="{{ route('forms.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Save & Exit
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Builder Area -->
        <div class="flex-1 p-6">
            <div class="max-w-4xl mx-auto">
                <div id="form-builder" class="bg-white rounded-lg border-2 border-dashed border-gray-300 min-h-96 p-6">
                    @if($form->fields->count() > 0)
                        <div id="form-fields" class="space-y-4">
                            @foreach($form->fields as $field)
                                <div class="field-item bg-gray-50 border border-gray-200 rounded-lg p-4" data-field-id="{{ $field->id }}">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center mb-2">
                                                <span class="drag-handle text-gray-400 mr-2 cursor-move">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                                    </svg>
                                                </span>
                                                <span class="text-sm font-medium text-gray-900">{{ $field->label }}</span>
                                                @if($field->is_required)
                                                    <span class="ml-2 text-red-500 text-xs">*</span>
                                                @endif
                                                <span class="ml-2 text-xs text-gray-500 bg-gray-200 px-2 py-1 rounded">{{ ucfirst($field->type) }}</span>
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                @if($field->type === 'text' || $field->type === 'email' || $field->type === 'number')
                                                    <input type="{{ $field->type }}" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                                                @elseif($field->type === 'textarea')
                                                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md" rows="3" disabled></textarea>
                                                @elseif($field->type === 'select')
                                                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                                                        <option>Select an option</option>
                                                        @if($field->options)
                                                            @foreach($field->options as $option)
                                                                <option>{{ $option }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                @elseif($field->type === 'multiselect')
                                                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled multiple>
                                                        @if($field->options)
                                                            @foreach($field->options as $option)
                                                                <option>{{ $option }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple options</p>
                                                @elseif($field->type === 'checkbox')
                                                    <div class="space-y-2">
                                                        @if($field->options)
                                                            @foreach($field->options as $option)
                                                                <label class="flex items-center">
                                                                    <input type="checkbox" class="mr-2" disabled>
                                                                    <span class="text-sm">{{ $option }}</span>
                                                                </label>
                                                            @endforeach
                                                        @else
                                                            <label class="flex items-center">
                                                                <input type="checkbox" class="mr-2" disabled>
                                                                <span class="text-sm">{{ $field->label }}</span>
                                                            </label>
                                                        @endif
                                                    </div>
                                                @elseif($field->type === 'single-checkbox')
                                                    <div class="space-y-2">
                                                        <label class="flex items-center">
                                                            <input type="checkbox" class="mr-2" disabled>
                                                            <span class="text-sm">{{ $field->label }}</span>
                                                        </label>
                                                    </div>
                                                @elseif($field->type === 'date')
                                                    <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                                                @elseif($field->type === 'file')
                                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                                                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                        </svg>
                                                        <p class="mt-2 text-sm text-gray-600">Click to upload or drag and drop</p>
                                                        <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex space-x-2 ml-4">
                                            <button onclick="editField({{ $field->id }})" class="text-blue-600 hover:text-blue-800">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button onclick="deleteField({{ $field->id }})" class="text-red-600 hover:text-red-800">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-gray-400 mb-4">
                                <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Start building your form</h3>
                            <p class="text-gray-600">Drag fields from the sidebar to create your form</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Field Edit Modal -->
<div id="field-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Field</h3>
            <form id="field-form">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Field Type</label>
                        <select id="field-type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="toggleOptionsContainer()">
                            <option value="text">Text Input</option>
                            <option value="email">Email</option>
                            <option value="number">Number</option>
                            <option value="textarea">Textarea</option>
                            <option value="select">Single Select Dropdown</option>
                            <option value="multiselect">Multi-Select Dropdown</option>
                            <option value="checkbox">Checkbox Group</option>
                            <option value="single-checkbox">Single Checkbox</option>
                            <option value="radio">Radio</option>
                            <option value="date">Date</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Field Label</label>
                        <input type="text" id="field-label" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Field Name</label>
                        <input type="text" id="field-name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="field-description" rows="2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" id="field-required" class="mr-2">
                            <span class="text-sm font-medium text-gray-700">Required field</span>
                        </label>
                    </div>
                    <div id="options-container" class="hidden">
                        <label class="block text-sm font-medium text-gray-700">Options (one per line)</label>
                        <textarea id="field-options" rows="6" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Option 1&#10;Option 2&#10;Option 3&#10;Option 4&#10;Option 5"></textarea>
                        <p class="mt-1 text-sm text-gray-500">Enter each option on a new line. You can add as many options as needed.</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeFieldModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Save Field
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentFieldId = null;
let currentFieldType = null;

// Initialize drag and drop
document.addEventListener('DOMContentLoaded', function() {
    const formBuilder = document.getElementById('form-builder');
    const formFields = document.getElementById('form-fields');
    
    // Make form fields sortable
    if (formFields) {
        new Sortable(formFields, {
            handle: '.drag-handle',
            animation: 200,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'dragging',
            forceFallback: true,
            fallbackClass: 'sortable-fallback',
            onStart: function(evt) {
                evt.item.classList.add('dragging');
            },
            onEnd: function(evt) {
                evt.item.classList.remove('dragging');
                updateFieldOrder();
            }
        });
    }

    // Make form builder a drop zone
    formBuilder.addEventListener('dragover', function(e) {
        e.preventDefault();
        formBuilder.classList.add('border-blue-400', 'bg-blue-50');
    });

    formBuilder.addEventListener('dragleave', function(e) {
        e.preventDefault();
        formBuilder.classList.remove('border-blue-400', 'bg-blue-50');
    });

    formBuilder.addEventListener('drop', function(e) {
        e.preventDefault();
        formBuilder.classList.remove('border-blue-400', 'bg-blue-50');
        
        const fieldType = e.dataTransfer.getData('text/plain');
        if (fieldType) {
            addFieldToForm(fieldType);
        }
    });

    // Make field templates draggable
    document.querySelectorAll('.field-template').forEach(function(template) {
        template.draggable = true;
        template.addEventListener('dragstart', function(e) {
            e.dataTransfer.setData('text/plain', this.dataset.type);
        });
    });
});

function addFieldToForm(type) {
    const fieldName = prompt('Enter field name (e.g., "company_name"):');
    if (!fieldName) return;
    
    const fieldLabel = prompt('Enter field label (e.g., "Company Name"):');
    if (!fieldLabel) return;
    
    const isRequired = confirm('Is this field required?');
    
    let options = null;
    if (type === 'select' || type === 'multiselect' || type === 'checkbox' || type === 'radio') {
        // Create a better interface for multiple options
        let optionsText = '';
        let optionCount = 1;
        
        while (true) {
            const option = prompt(`Enter option ${optionCount} (leave empty to finish):\n\nCurrent options:\n${optionsText}`);
            if (!option || option.trim() === '') break;
            
            optionsText += (optionsText ? '\n' : '') + option.trim();
            optionCount++;
        }
        
        if (optionsText) {
            options = optionsText.split('\n').filter(opt => opt.trim() !== '');
        }
    }
    
    const formData = new FormData();
    formData.append('name', fieldName);
    formData.append('label', fieldLabel);
    formData.append('type', type);
    formData.append('is_required', isRequired ? '1' : '0');
    if (options) {
        formData.append('options', JSON.stringify(options));
    }
    formData.append('_token', window.Laravel.csrfToken);
    
    fetch(`{{ route('form-fields.store', $form->slug) }}`, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        return response.text().then(text => {
            try {
                return JSON.parse(text);
            } catch (e) {
                throw new Error(`Server returned invalid JSON: ${text.substring(0, 100)}...`);
            }
        });
    })
    .then(data => {
        if (data.errors) {
            console.error('Validation errors:', data.errors);
            alert('Validation errors: ' + JSON.stringify(data.errors));
        } else if (data.error) {
            console.error('Server error:', data.error);
            alert('Server error: ' + data.error);
        } else {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error adding field: ' + error.message);
    });
}

function editField(fieldId) {
    // This would open the modal with field data
    // For now, we'll just show an alert
    alert('Edit field functionality will be implemented');
}

// Show/hide options container based on field type
function toggleOptionsContainer(fieldType) {
    const optionsContainer = document.getElementById('options-container');
    if (fieldType === 'select' || fieldType === 'checkbox' || fieldType === 'radio') {
        optionsContainer.classList.remove('hidden');
    } else {
        optionsContainer.classList.add('hidden');
    }
}

function deleteField(fieldId) {
    if (confirm('Are you sure you want to delete this field?')) {
        fetch(`{{ url('forms/' . $form->slug . '/fields') }}/${fieldId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting field');
        });
    }
}

function updateFieldOrder() {
    const fields = document.querySelectorAll('[data-field-id]');
    const fieldData = Array.from(fields).map((field, index) => ({
        id: field.dataset.fieldId,
        sort_order: index
    }));
    
    fetch(`{{ route('form-fields.order', $form->slug) }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        },
        body: JSON.stringify({ fields: fieldData })
    })
    .catch(error => {
        console.error('Error updating field order:', error);
    });
}

function closeFieldModal() {
    document.getElementById('field-modal').classList.add('hidden');
}
</script>
@endpush

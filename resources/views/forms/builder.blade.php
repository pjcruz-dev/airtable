@extends('layouts.app')

@section('title', 'Form Builder - ' . $form->name)

@section('content')
<style>
    /* Custom Checkbox Enhancement */
    .checkbox-custom {
        transition: all 0.2s ease;
    }
    
    .checkbox-custom.checked {
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        border-color: #3b82f6;
    }
    
    .checkbox-custom.checked svg {
        opacity: 1;
    }
</style>
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
            <div class="max-w-6xl mx-auto">
                <!-- Preview Toggle -->
                <div class="mb-6 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $form->name }}</h1>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Preview Mode:</span>
                            <button id="preview-toggle" class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" onclick="togglePreview()">
                                <span id="preview-toggle-slider" class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                            </button>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('forms.vendor-form', $form) }}" target="_blank" class="px-4 py-2 text-sm bg-green-600 text-white rounded-md hover:bg-green-700">
                            View Live Form
                        </a>
                        <a href="{{ route('forms.submissions', $form) }}" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            View Submissions
                        </a>
                    </div>
                </div>

                <!-- Split Layout -->
                <div id="builder-layout" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Form Builder -->
                    <div id="form-builder-panel" class="space-y-4">
                        <div class="bg-white rounded-lg border border-gray-200 p-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Form Builder</h3>
                            <div id="form-builder" class="bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 min-h-96 p-6">
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

                    <!-- Live Preview Panel -->
                    <div id="preview-panel" class="space-y-4">
                        <div class="bg-white rounded-lg border border-gray-200 p-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Live Preview</h3>
                            <div id="live-preview" class="bg-gray-50 rounded-lg border border-gray-200 p-6 min-h-96">
                                <div class="space-y-4">
                                    <div class="text-center py-8">
                                        <div class="text-gray-400 mb-4">
                                            <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Form Preview</h3>
                                        <p class="text-gray-600">Add fields to see live preview</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Field Edit Modal -->
<div id="field-modal" class="hidden fixed inset-0 bg-gradient-to-br from-gray-900 via-black to-gray-800 overflow-y-auto h-full w-full z-50 backdrop-blur-lg flex items-start justify-center pt-20" onclick="closeModalOnBackdrop(event)" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="relative mx-auto p-3 border-0 w-72 shadow-2xl rounded-xl bg-white transform transition-all duration-300 ease-out ring-1 ring-gray-200">
        <div class="p-3 bg-gradient-to-br from-white to-gray-50 rounded-xl">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-3 pb-2 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h3 id="modal-title" class="text-xl font-bold text-gray-900">Add New Field</h3>
                </div>
                <button onclick="closeFieldModal()" class="text-gray-400 hover:text-gray-600 transition-all duration-200 p-2 rounded-full hover:bg-gray-100 hover:scale-110">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="field-form" onsubmit="handleFieldFormSubmit(event)">
                <div class="space-y-3">
                    <!-- Field Type -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-2 border border-blue-100">
                        <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Field Type
                        </label>
                        <select id="field-type" class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white shadow-sm hover:shadow-md" onchange="toggleOptionsContainer()">
                            <option value="text">📝 Text Input</option>
                            <option value="email">📧 Email</option>
                            <option value="number">🔢 Number</option>
                            <option value="textarea">📄 Textarea</option>
                            <option value="select">📋 Single Select Dropdown</option>
                            <option value="multiselect">☑️ Multi-Select Dropdown</option>
                            <option value="checkbox">☑️ Checkbox Group</option>
                            <option value="single-checkbox">☑️ Single Checkbox</option>
                            <option value="radio">🔘 Radio</option>
                            <option value="date">📅 Date</option>
                            <option value="file">📎 File Upload</option>
                        </select>
                    </div>

                    <!-- Field Label -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-2 border border-green-100">
                        <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Field Label
                        </label>
                        <input type="text" id="field-label" class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 shadow-sm hover:shadow-md" placeholder="Enter field label" required>
                    </div>

                    <!-- Field Name -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-2 border border-purple-100">
                        <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Field Name
                        </label>
                        <input type="text" id="field-name" class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 shadow-sm hover:shadow-md" placeholder="Enter field name" required>
                    </div>

                    <!-- Description -->
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl p-2 border border-yellow-100">
                        <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Description
                        </label>
                        <textarea id="field-description" rows="2" class="w-full px-4 py-3 border-2 border-yellow-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 resize-none shadow-sm hover:shadow-md" placeholder="Optional field description"></textarea>
                    </div>

                    <!-- Required Field -->
                    <div class="bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl p-3 border border-gray-200">
                        <label class="flex items-center cursor-pointer group">
                            <div class="relative">
                                <input type="checkbox" id="field-required" class="sr-only" onchange="toggleCheckbox(this)">
                                <div class="w-6 h-6 bg-white border-2 border-gray-300 rounded-lg group-hover:border-blue-500 transition-all duration-200 flex items-center justify-center checkbox-custom">
                                    <svg class="w-4 h-4 text-white opacity-0 transition-opacity duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <span class="ml-3 text-sm font-semibold text-gray-700 group-hover:text-gray-900 transition-colors duration-200">Required field</span>
                        </label>
                    </div>

                    <!-- Options Container -->
                    <div id="options-container" class="hidden">
                        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl p-3 border border-indigo-200">
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Options
                            </label>
                            <textarea id="field-options" rows="4" class="w-full px-4 py-3 border-2 border-indigo-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 resize-none shadow-sm hover:shadow-md" placeholder="Option 1&#10;Option 2&#10;Option 3&#10;Option 4&#10;Option 5"></textarea>
                            <p class="text-xs text-indigo-600 mt-2 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Enter one option per line
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="mt-6 pt-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="button" onclick="closeFieldModal()" class="px-4 py-2 text-gray-700 bg-gradient-to-r from-gray-100 to-gray-200 rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-200 font-semibold shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
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
    // Clear form and set up for new field
    document.getElementById('field-form').reset();
    document.getElementById('field-type').value = type;
    document.getElementById('options-container').classList.add('hidden');
    
    // Reset checkbox visual state
    const checkbox = document.getElementById('field-required');
    const checkboxDiv = checkbox.nextElementSibling;
    checkboxDiv.classList.remove('checked');
    
    // Set current field ID to null for new field
    currentFieldId = null;
    currentFieldType = type;
    
    // Update modal title
    document.getElementById('modal-title').textContent = 'Add New Field';
    
    // Show/hide options based on field type
    toggleOptionsContainer();
    
    // Show the modal with animation
    const modal = document.getElementById('field-modal');
    const modalContent = modal.querySelector('.relative');
    
    modal.classList.remove('hidden');
    modalContent.style.transform = 'scale(0.95) translateY(-10px)';
    modalContent.style.opacity = '0';
    
    setTimeout(() => {
        modalContent.style.transform = 'scale(1) translateY(0)';
        modalContent.style.opacity = '1';
    }, 10);
}

function editField(fieldId) {
    // Fetch field data and populate the modal
    fetch(`{{ url('forms/' . $form->slug . '/fields') }}/${fieldId}`)
        .then(response => response.json())
        .then(field => {
            // Populate the modal with field data
            document.getElementById('field-type').value = field.type;
            document.getElementById('field-label').value = field.label;
            document.getElementById('field-name').value = field.name;
            document.getElementById('field-description').value = field.description || '';
            document.getElementById('field-required').checked = field.is_required;
            
            // Handle options for fields that have them
            if (field.options && Array.isArray(field.options)) {
                document.getElementById('field-options').value = field.options.join('\n');
                document.getElementById('options-container').classList.remove('hidden');
            } else {
                document.getElementById('field-options').value = '';
                document.getElementById('options-container').classList.add('hidden');
            }
            
            // Set current field ID for update
            currentFieldId = fieldId;
            currentFieldType = field.type;
            
            // Update modal title
            document.getElementById('modal-title').textContent = 'Edit Field';
            
            // Show the modal with animation
            const modal = document.getElementById('field-modal');
            const modalContent = modal.querySelector('.relative');
            
            modal.classList.remove('hidden');
            modalContent.style.transform = 'scale(0.95) translateY(-10px)';
            modalContent.style.opacity = '0';
            
            setTimeout(() => {
                modalContent.style.transform = 'scale(1) translateY(0)';
                modalContent.style.opacity = '1';
            }, 10);
        })
        .catch(error => {
            console.error('Error fetching field:', error);
            alert('Error loading field data');
        });
}

// Show/hide options container based on field type
function toggleOptionsContainer(fieldType) {
    const fieldTypeValue = fieldType || document.getElementById('field-type').value;
    const optionsContainer = document.getElementById('options-container');
    if (fieldTypeValue === 'select' || fieldTypeValue === 'multiselect' || fieldTypeValue === 'checkbox' || fieldTypeValue === 'radio') {
        optionsContainer.classList.remove('hidden');
    } else {
        optionsContainer.classList.add('hidden');
    }
}

// Toggle checkbox visual state
function toggleCheckbox(checkbox) {
    const checkboxDiv = checkbox.nextElementSibling;
    if (checkbox.checked) {
        checkboxDiv.classList.add('checked');
    } else {
        checkboxDiv.classList.remove('checked');
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
            refreshPreview();
            // Reload to get updated field data
            setTimeout(() => location.reload(), 500);
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
    .then(() => {
        refreshPreview();
    })
    .catch(error => {
        console.error('Error updating field order:', error);
    });
}

function closeFieldModal() {
    const modal = document.getElementById('field-modal');
    const modalContent = modal.querySelector('.relative');
    
    // Add closing animation
    modalContent.style.transform = 'scale(0.95) translateY(-10px)';
    modalContent.style.opacity = '0';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modalContent.style.transform = 'scale(1) translateY(0)';
        modalContent.style.opacity = '1';
    }, 200);
    
    currentFieldId = null;
    currentFieldType = null;
    // Clear form
    document.getElementById('field-form').reset();
    document.getElementById('options-container').classList.add('hidden');
}

function closeModalOnBackdrop(event) {
    if (event.target === event.currentTarget) {
        closeFieldModal();
    }
}

function handleFieldFormSubmit(event) {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('name', document.getElementById('field-name').value);
    formData.append('label', document.getElementById('field-label').value);
    formData.append('type', document.getElementById('field-type').value);
    formData.append('description', document.getElementById('field-description').value);
    formData.append('is_required', document.getElementById('field-required').checked ? '1' : '0');
    
    // Handle options
    const optionsText = document.getElementById('field-options').value;
    if (optionsText.trim()) {
        const options = optionsText.split('\n').filter(opt => opt.trim() !== '');
        formData.append('options', JSON.stringify(options));
    }
    
    formData.append('_token', window.Laravel.csrfToken);
    
    const url = currentFieldId 
        ? `{{ url('forms/' . $form->slug . '/fields') }}/${currentFieldId}`
        : `{{ route('form-fields.store', $form->slug) }}`;
    
    const method = currentFieldId ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.text().then(text => {
            try {
                return JSON.parse(text);
            } catch (e) {
                console.error('Server response:', text);
                throw new Error(`Server returned invalid JSON. Status: ${response.status}`);
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
            closeFieldModal();
            refreshPreview();
            // Reload to get updated field data
            setTimeout(() => location.reload(), 500);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving field: ' + error.message);
    });
}

// Live Preview Functions
let previewMode = false;

function togglePreview() {
    previewMode = !previewMode;
    const toggle = document.getElementById('preview-toggle');
    const slider = document.getElementById('preview-toggle-slider');
    const layout = document.getElementById('builder-layout');
    const previewPanel = document.getElementById('preview-panel');
    
    if (previewMode) {
        toggle.classList.remove('bg-gray-200');
        toggle.classList.add('bg-blue-600');
        slider.classList.add('translate-x-5');
        previewPanel.classList.remove('hidden');
        layout.classList.remove('grid-cols-1');
        layout.classList.add('lg:grid-cols-2');
        updateLivePreview();
    } else {
        toggle.classList.remove('bg-blue-600');
        toggle.classList.add('bg-gray-200');
        slider.classList.remove('translate-x-5');
        previewPanel.classList.add('hidden');
        layout.classList.remove('lg:grid-cols-2');
        layout.classList.add('grid-cols-1');
    }
}

function updateLivePreview() {
    if (!previewMode) return;
    
    const previewContainer = document.getElementById('live-preview');
    const formFields = document.querySelectorAll('#form-fields .field-item');
    
    if (formFields.length === 0) {
        previewContainer.innerHTML = `
            <div class="text-center py-8">
                <div class="text-gray-400 mb-4">
                    <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Form Preview</h3>
                <p class="text-gray-600">Add fields to see live preview</p>
            </div>
        `;
        return;
    }
    
    let previewHTML = `
        <div class="space-y-6">
            <div class="text-center border-b border-gray-200 pb-4">
                <h2 class="text-2xl font-bold text-gray-900">{{ $form->name }}</h2>
                @if($form->description)
                    <p class="text-gray-600 mt-2">{{ $form->description }}</p>
                @endif
            </div>
            <form class="space-y-6">
    `;
    
    formFields.forEach(fieldElement => {
        const fieldId = fieldElement.dataset.fieldId;
        const labelElement = fieldElement.querySelector('.text-sm.font-medium');
        const typeElement = fieldElement.querySelector('.text-xs.text-gray-500');
        const previewElement = fieldElement.querySelector('.text-sm.text-gray-600 > *:first-child');
        
        if (!labelElement || !typeElement) return;
        
        const label = labelElement.textContent.trim();
        const type = typeElement.textContent.trim().toLowerCase();
        const isRequired = labelElement.querySelector('.text-red-500') !== null;
        
        previewHTML += `
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    ${label}
                    ${isRequired ? '<span class="text-red-500">*</span>' : ''}
                </label>
        `;
        
        // Generate preview input based on type
        switch(type) {
            case 'text':
            case 'email':
            case 'number':
                previewHTML += `<input type="${type}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter ${label.toLowerCase()}">`;
                break;
            case 'textarea':
                previewHTML += `<textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" rows="3" placeholder="Enter ${label.toLowerCase()}"></textarea>`;
                break;
            case 'select':
                previewHTML += `<select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option>Select an option</option>
                </select>`;
                break;
            case 'multiselect':
                previewHTML += `<select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" multiple>
                    <option>Select options</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple options</p>`;
                break;
            case 'checkbox':
                previewHTML += `<div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <span class="text-sm text-gray-700">Option 1</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <span class="text-sm text-gray-700">Option 2</span>
                    </label>
                </div>`;
                break;
            case 'single-checkbox':
                previewHTML += `<label class="flex items-center">
                    <input type="checkbox" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <span class="text-sm text-gray-700">${label}</span>
                </label>`;
                break;
            case 'radio':
                previewHTML += `<div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="preview_${fieldId}" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <span class="text-sm text-gray-700">Option 1</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="preview_${fieldId}" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <span class="text-sm text-gray-700">Option 2</span>
                    </label>
                </div>`;
                break;
            case 'date':
                previewHTML += `<input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">`;
                break;
            case 'file':
                previewHTML += `<div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                    <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
                </div>`;
                break;
        }
        
        previewHTML += `</div>`;
    });
    
    previewHTML += `
            </form>
            <div class="pt-6 border-t border-gray-200">
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Submit Form
                </button>
            </div>
        </div>
    `;
    
    previewContainer.innerHTML = previewHTML;
}

// Update preview when fields change
function refreshPreview() {
    if (previewMode) {
        setTimeout(updateLivePreview, 100); // Small delay to ensure DOM is updated
    }
}

// Initialize preview on page load
document.addEventListener('DOMContentLoaded', function() {
    // Set up observer to watch for changes in form fields
    const formBuilder = document.getElementById('form-builder');
    if (formBuilder) {
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'childList') {
                    refreshPreview();
                }
            });
        });
        
        observer.observe(formBuilder, {
            childList: true,
            subtree: true
        });
    }
    
    // Add ESC key listener to close modal
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('field-modal');
            if (!modal.classList.contains('hidden')) {
                closeFieldModal();
            }
        }
    });
});
</script>
@endpush

@extends('layouts.app')

@section('title', 'Form Templates')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Form Templates</h1>
            <p class="text-gray-600">Choose from pre-built form templates to get started quickly</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('forms.create') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                Create Empty Form
            </a>
            <a href="{{ route('forms.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Back to Forms
            </a>
        </div>
    </div>
</div>

@foreach($templates as $category => $categoryTemplates)
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4 capitalize">{{ $category }} Forms</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categoryTemplates as $template)
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                @if($template->icon)
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if($template->icon === 'contact')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            @elseif($template->icon === 'survey')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                            @elseif($template->icon === 'registration')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            @elseif($template->icon === 'feedback')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                            @elseif($template->icon === 'order')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            @endif
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-medium text-gray-900">{{ $template->name }}</h3>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 mb-4">{{ $template->description }}</p>
                        
                        <div class="mb-4">
                            <div class="text-sm text-gray-500 mb-2">Fields included:</div>
                            <div class="flex flex-wrap gap-1">
                                @foreach($template->fields_data as $field)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ ucfirst($field['type']) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="flex space-x-2">
                            <button onclick="previewTemplate({{ $template->id }})" class="flex-1 px-3 py-2 text-sm text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                                Preview
                            </button>
                            <button onclick="createFromTemplate({{ $template->id }})" class="flex-1 px-3 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Use Template
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach

<!-- Template Preview Modal -->
<div id="preview-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-4/5 max-w-4xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Template Preview</h3>
                <button onclick="closePreviewModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="preview-content">
                <!-- Preview content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Create Form Modal -->
<div id="create-form-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Create Form from Template</h3>
            <form id="create-form-form" onsubmit="handleCreateForm(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Form Name</label>
                        <input type="text" id="form-name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                        <textarea id="form-description" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeCreateFormModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Create Form
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentTemplateId = null;

function previewTemplate(templateId) {
    currentTemplateId = templateId;
    
    // Fetch template data and show preview
    fetch(`/templates/${templateId}/preview`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('preview-content').innerHTML = html;
            document.getElementById('preview-modal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error loading preview:', error);
            alert('Error loading template preview');
        });
}

function createFromTemplate(templateId) {
    currentTemplateId = templateId;
    document.getElementById('create-form-modal').classList.remove('hidden');
}

function closePreviewModal() {
    document.getElementById('preview-modal').classList.add('hidden');
    document.getElementById('preview-content').innerHTML = '';
}

function closeCreateFormModal() {
    document.getElementById('create-form-modal').classList.add('hidden');
    document.getElementById('create-form-form').reset();
}

function handleCreateForm(event) {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('name', document.getElementById('form-name').value);
    formData.append('description', document.getElementById('form-description').value);
    formData.append('_token', window.Laravel.csrfToken);
    
    fetch(`/templates/${currentTemplateId}/create-form`, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            return response.text();
        }
        throw new Error('Network response was not ok');
    })
    .then(() => {
        closeCreateFormModal();
        window.location.href = '/forms';
    })
    .catch(error => {
        console.error('Error creating form:', error);
        alert('Error creating form from template');
    });
}
</script>
@endpush

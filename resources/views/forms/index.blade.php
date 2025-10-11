@extends('layouts.app')

@section('title', 'Forms')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Forms</h1>
    <p class="mt-2 text-gray-600">Create and manage your custom forms</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($forms as $form)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $form->name }}</h3>
                    @if($form->description)
                        <p class="mt-2 text-sm text-gray-600">{{ Str::limit($form->description, 100) }}</p>
                    @endif
                    <div class="mt-4 flex items-center text-sm text-gray-500">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $form->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $form->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <span class="ml-3">{{ $form->fields->count() }} fields</span>
                        <span class="ml-3">{{ $form->submissions->count() }} submissions</span>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex space-x-3">
                <a href="{{ route('forms.builder', $form) }}" class="flex-1 bg-blue-600 text-white text-center px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                    Edit Form
                </a>
                <a href="{{ route('forms.submissions', $form) }}" class="flex-1 bg-gray-100 text-gray-700 text-center px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-200">
                    View Data
                </a>
                <div class="relative">
                    <button onclick="toggleDropdown({{ $form->id }})" class="bg-gray-100 text-gray-700 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200">
                        ⋮
                    </button>
                    <div id="dropdown-{{ $form->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 border border-gray-200">
                        <div class="py-1">
                            <a href="{{ route('forms.vendor-form', $form) }}" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                View Form
                            </a>
                            <a href="{{ route('forms.edit', $form) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Settings
                            </a>
                            <form method="POST" action="{{ route('forms.destroy', $form) }}" class="block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100" onclick="return confirm('Are you sure you want to delete this form?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <div class="text-gray-400 mb-4">
                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No forms yet</h3>
            <p class="text-gray-600 mb-6">Get started by creating your first form</p>
            <a href="{{ route('forms.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md font-medium hover:bg-blue-700">
                Create Your First Form
            </a>
        </div>
    @endforelse
</div>

@if($forms->hasPages())
    <div class="mt-8">
        {{ $forms->links() }}
    </div>
@endif
@endsection

@push('scripts')
<script>
function toggleDropdown(formId) {
    const dropdown = document.getElementById('dropdown-' + formId);
    const isHidden = dropdown.classList.contains('hidden');
    
    // Close all other dropdowns
    document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
        el.classList.add('hidden');
    });
    
    // Toggle current dropdown
    if (isHidden) {
        dropdown.classList.remove('hidden');
    }
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('[onclick^="toggleDropdown"]') && !event.target.closest('[id^="dropdown-"]')) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            el.classList.add('hidden');
        });
    }
});
</script>
@endpush

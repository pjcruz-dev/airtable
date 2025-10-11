@extends('layouts.app')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('title', 'Submissions - ' . $form->name)

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $form->name }} - Submissions</h1>
            <p class="mt-2 text-gray-600">View and manage form submissions</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('forms.submissions.export', $form) }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                Export CSV
            </a>
            <a href="{{ route('forms.builder', $form) }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                Edit Form
            </a>
            <a href="{{ route('forms.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Back to Forms
            </a>
        </div>
    </div>
</div>

@if($submissions->count() > 0)
    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
        <div class="flex items-center space-x-4">
            <div>
                <label for="status-filter" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status-filter" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                <input type="text" id="search" placeholder="Search submissions..." class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
    </div>

    <!-- Submissions Grid -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submission ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted By</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted At</th>
                        @foreach($form->fields as $field)
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $field->label }}</th>
                        @endforeach
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($submissions as $submission)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">
                                {{ Str::limit($submission->submission_id, 8) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $submission->submitted_by ?? 'Anonymous' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $submission->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                       ($submission->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($submission->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $submission->created_at->format('M j, Y g:i A') }}
                            </td>
                            @foreach($form->fields as $field)
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    @php
                                        $value = $submission->getFieldValue($field->name);
                                    @endphp
                                    @if($field->type === 'file' && $value)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <a href="{{ route('file.download', basename($value)) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                                                {{ basename($value) }}
                                            </a>
                                        </div>
                                    @elseif(is_array($value))
                                        {{ implode(', ', $value) }}
                                    @else
                                        {{ Str::limit($value ?? '', 50) }}
                                    @endif
                                </td>
                            @endforeach
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button onclick="viewSubmission({{ $submission->id }})" class="text-blue-600 hover:text-blue-900">
                                        View
                                    </button>
                                    <div class="relative">
                                        <button onclick="toggleStatusDropdown({{ $submission->id }})" class="text-gray-600 hover:text-gray-900">
                                            Status
                                        </button>
                                        <div id="status-dropdown-{{ $submission->id }}" class="hidden absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg z-10 border border-gray-200">
                                            <div class="py-1">
                                                <button onclick="updateStatus({{ $submission->id }}, 'pending')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    Pending
                                                </button>
                                                <button onclick="updateStatus({{ $submission->id }}, 'approved')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    Approve
                                                </button>
                                                <button onclick="updateStatus({{ $submission->id }}, 'rejected')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    Reject
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button onclick="deleteSubmission({{ $submission->id }})" class="text-red-600 hover:text-red-900">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if($submissions->hasPages())
        <div class="mt-6">
            {{ $submissions->links() }}
        </div>
    @endif
@else
    <div class="text-center py-12">
        <div class="text-gray-400 mb-4">
            <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No submissions yet</h3>
        <p class="text-gray-600 mb-6">Submissions will appear here once vendors start filling out your form</p>
        <a href="{{ route('forms.vendor-form', $form) }}" target="_blank" class="bg-blue-600 text-white px-6 py-3 rounded-md font-medium hover:bg-blue-700">
            Preview Form
        </a>
    </div>
@endif

<!-- Submission Detail Modal -->
<div id="submission-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Submission Details</h3>
                <button onclick="closeSubmissionModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="submission-content">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function viewSubmission(submissionId) {
    // This would load submission details in the modal
    // For now, we'll just show an alert
    alert('View submission functionality will be implemented');
}

function toggleStatusDropdown(submissionId) {
    const dropdown = document.getElementById('status-dropdown-' + submissionId);
    const isHidden = dropdown.classList.contains('hidden');
    
    // Close all other dropdowns
    document.querySelectorAll('[id^="status-dropdown-"]').forEach(el => {
        el.classList.add('hidden');
    });
    
    // Toggle current dropdown
    if (isHidden) {
        dropdown.classList.remove('hidden');
    }
}

function updateStatus(submissionId, status) {
    if (confirm(`Are you sure you want to mark this submission as ${status}?`)) {
        fetch(`{{ url('forms/' . $form->slug . '/submissions') }}/${submissionId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating status');
        });
    }
}

function deleteSubmission(submissionId) {
    if (confirm('Are you sure you want to delete this submission?')) {
        fetch(`{{ url('forms/' . $form->slug . '/submissions') }}/${submissionId}`, {
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
            alert('Error deleting submission');
        });
    }
}

function closeSubmissionModal() {
    document.getElementById('submission-modal').classList.add('hidden');
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('[onclick^="toggleStatusDropdown"]') && !event.target.closest('[id^="status-dropdown-"]')) {
        document.querySelectorAll('[id^="status-dropdown-"]').forEach(el => {
            el.classList.add('hidden');
        });
    }
});
</script>
@endpush

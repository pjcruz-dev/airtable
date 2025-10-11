@extends('layouts.app')

@section('title', 'Edit Form - ' . $form->name)

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Form Settings</h1>
        <p class="mt-2 text-gray-600">Update your form information</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('forms.update', $form) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Form Name *
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $form->name) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $form->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1"
                           {{ old('is_active', $form->is_active) ? 'checked' : '' }}
                           class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <span class="text-sm font-medium text-gray-700">Form is active (vendors can submit)</span>
                </label>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('forms.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Update Form
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

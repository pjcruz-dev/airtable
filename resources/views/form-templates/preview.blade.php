<div class="space-y-6">
    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="text-lg font-medium text-gray-900 mb-2">{{ $template->name }}</h4>
        <p class="text-gray-600">{{ $template->description }}</p>
    </div>
    
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h5 class="text-md font-medium text-gray-900 mb-4">Form Preview</h5>
        
        <div class="space-y-4">
            @foreach($template->fields_data as $field)
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        {{ $field['label'] }}
                        @if($field['is_required'] ?? false)
                            <span class="text-red-500">*</span>
                        @endif
                    </label>
                    
                    @if($field['description'] ?? false)
                        <p class="text-sm text-gray-500">{{ $field['description'] }}</p>
                    @endif
                    
                    <div class="mt-1">
                        @if($field['type'] === 'text' || $field['type'] === 'email' || $field['type'] === 'number')
                            <input type="{{ $field['type'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                        @elseif($field['type'] === 'textarea')
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md" rows="3" disabled></textarea>
                        @elseif($field['type'] === 'select')
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                                <option>Select an option</option>
                                @if(isset($field['options']) && is_array($field['options']))
                                    @foreach($field['options'] as $option)
                                        <option>{{ $option }}</option>
                                    @endforeach
                                @endif
                            </select>
                        @elseif($field['type'] === 'multiselect')
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled multiple>
                                @if(isset($field['options']) && is_array($field['options']))
                                    @foreach($field['options'] as $option)
                                        <option>{{ $option }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple options</p>
                        @elseif($field['type'] === 'checkbox')
                            <div class="space-y-2">
                                @if(isset($field['options']) && is_array($field['options']))
                                    @foreach($field['options'] as $option)
                                        <label class="flex items-center">
                                            <input type="checkbox" class="mr-2" disabled>
                                            <span class="text-sm">{{ $option }}</span>
                                        </label>
                                    @endforeach
                                @else
                                    <label class="flex items-center">
                                        <input type="checkbox" class="mr-2" disabled>
                                        <span class="text-sm">{{ $field['label'] }}</span>
                                    </label>
                                @endif
                            </div>
                        @elseif($field['type'] === 'single-checkbox')
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="mr-2" disabled>
                                    <span class="text-sm">{{ $field['label'] }}</span>
                                </label>
                            </div>
                        @elseif($field['type'] === 'radio')
                            <div class="space-y-2">
                                @if(isset($field['options']) && is_array($field['options']))
                                    @foreach($field['options'] as $option)
                                        <label class="flex items-center">
                                            <input type="radio" name="preview_{{ $field['name'] }}" class="mr-2" disabled>
                                            <span class="text-sm">{{ $option }}</span>
                                        </label>
                                    @endforeach
                                @endif
                            </div>
                        @elseif($field['type'] === 'date')
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                        @elseif($field['type'] === 'file')
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
            @endforeach
        </div>
        
        <div class="mt-6 pt-4 border-t border-gray-200">
            <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-md" disabled>
                Submit Form
            </button>
        </div>
    </div>
</div>

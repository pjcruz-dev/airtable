<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Form Builder')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
            /* Additional fallback styles */
            .font-sans { font-family: system-ui, -apple-system, sans-serif; }
            .antialiased { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        </style>
    @endif
    
    <!-- Sortable.js for drag and drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    
    <!-- Additional CSS -->
    <style>
        .drag-handle {
            cursor: move;
        }
        
        /* Sortable.js styles */
        .sortable-ghost {
            opacity: 0.4;
            background: #f3f4f6;
        }
        
        .sortable-chosen {
            background: #dbeafe;
            border-color: #3b82f6;
        }
        
        .sortable-item {
            transition: all 0.2s ease;
        }
        
        .sortable-item:hover {
            background: #f9fafb;
        }
        
        .field-item {
            position: relative;
        }
        
        .dragging {
            transform: rotate(2deg);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        /* Modal Enhancements */
        .modal-backdrop {
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        
        .modal-content {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .modal-content.scale-in {
            animation: modalScaleIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .modal-content.scale-out {
            animation: modalScaleOut 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes modalScaleIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        
        @keyframes modalScaleOut {
            from {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
            to {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }
        }
        
        /* Enhanced form inputs */
        .form-input {
            transition: all 0.2s ease-in-out;
        }
        
        .form-input:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        
        /* Button hover effects */
        .btn-primary {
            transition: all 0.2s ease-in-out;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        /* Enhanced Modal Styling */
        .modal-enhanced {
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        
        .modal-content-enhanced {
            animation: modalSlideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        
        /* Enhanced Input Focus */
        .input-enhanced:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        
        /* Button Hover Effects */
        .btn-enhanced:hover {
            transform: translateY(-1px);
        }
        
        .btn-primary-enhanced:hover {
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }
        
        /* Enhanced Modal Background */
        .modal-backdrop-enhanced {
            background: linear-gradient(135deg, #1f2937 0%, #000000 50%, #374151 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        
        /* Enhanced Modal Content */
        .modal-content-enhanced {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Enhanced Form Sections */
        .form-section-blue {
            background: linear-gradient(135deg, #dbeafe 0%, #e0e7ff 100%);
            border: 1px solid #bfdbfe;
        }
        
        .form-section-green {
            background: linear-gradient(135deg, #dcfce7 0%, #ecfdf5 100%);
            border: 1px solid #bbf7d0;
        }
        
        .form-section-purple {
            background: linear-gradient(135deg, #f3e8ff 0%, #faf5ff 100%);
            border: 1px solid #d8b4fe;
        }
        
        .form-section-yellow {
            background: linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%);
            border: 1px solid #fde68a;
        }
        
        .form-section-indigo {
            background: linear-gradient(135deg, #e0e7ff 0%, #eef2ff 100%);
            border: 1px solid #c7d2fe;
        }
        
        /* Enhanced Input Focus */
        .input-enhanced:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
        }
        
        /* Enhanced Button Hover */
        .btn-enhanced:hover {
            transform: translateY(-2px);
        }
        
        /* Custom Checkbox */
        .custom-checkbox input:checked + div {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            border-color: #3b82f6;
        }
        
        .custom-checkbox input:checked + div svg {
            opacity: 1;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('forms.index') }}" class="text-xl font-bold text-gray-900">
                            Form Builder
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('forms.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                            Forms
                        </a>
                        <a href="{{ route('templates.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                            Templates
                        </a>
                        <a href="{{ route('activity-logs.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                            Activity Logs
                        </a>
                        <a href="{{ route('forms.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                            Create Form
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        // CSRF token setup for AJAX requests
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
    </script>
    @stack('scripts')
</body>
</html>

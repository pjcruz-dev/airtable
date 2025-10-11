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
        
        .field-item.dragging {
            transform: rotate(2deg);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
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

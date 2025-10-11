<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Form Builder')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
            /* Additional fallback styles */
            .font-sans { font-family: 'Inter', system-ui, -apple-system, sans-serif; }
            .antialiased { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
            
            /* Modern Design System */
            :root {
                --primary-50: #eff6ff;
                --primary-100: #dbeafe;
                --primary-500: #3b82f6;
                --primary-600: #2563eb;
                --primary-700: #1d4ed8;
                --primary-900: #1e3a8a;
                --gray-50: #f9fafb;
                --gray-100: #f3f4f6;
                --gray-200: #e5e7eb;
                --gray-300: #d1d5db;
                --gray-400: #9ca3af;
                --gray-500: #6b7280;
                --gray-600: #4b5563;
                --gray-700: #374151;
                --gray-800: #1f2937;
                --gray-900: #111827;
            }
            
            /* Smooth scrolling */
            html {
                scroll-behavior: smooth;
            }
            
            /* Modern shadows */
            .shadow-modern {
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            }
            
            .shadow-modern-lg {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
            
            .shadow-modern-xl {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            
            /* Additional utility classes */
            .bg-white\/80 {
                background-color: rgba(255, 255, 255, 0.8);
            }
            
            .backdrop-blur-md {
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }
            
            .sticky {
                position: sticky;
            }
            
            .top-0 {
                top: 0;
            }
            
            .z-40 {
                z-index: 40;
            }
            
            .z-50 {
                z-index: 50;
            }
            
            .z-20 {
                z-index: 20;
            }
            
            .h-20 {
                height: 5rem;
            }
            
            .w-10 {
                width: 2.5rem;
            }
            
            .h-10 {
                height: 2.5rem;
            }
            
            .w-6 {
                width: 1.5rem;
            }
            
            .h-6 {
                height: 1.5rem;
            }
            
            .w-5 {
                width: 1.25rem;
            }
            
            .h-5 {
                height: 1.25rem;
            }
            
            .w-4 {
                width: 1rem;
            }
            
            .h-4 {
                height: 1rem;
            }
            
            .w-3 {
                width: 0.75rem;
            }
            
            .h-3 {
                height: 0.75rem;
            }
            
            .rounded-xl {
                border-radius: 0.75rem;
            }
            
            .rounded-2xl {
                border-radius: 1rem;
            }
            
            .rounded-lg {
                border-radius: 0.5rem;
            }
            
            .rounded-full {
                border-radius: 9999px;
            }
            
            .text-2xl {
                font-size: 1.5rem;
                line-height: 2rem;
            }
            
            .text-xl {
                font-size: 1.25rem;
                line-height: 1.75rem;
            }
            
            .text-lg {
                font-size: 1.125rem;
                line-height: 1.75rem;
            }
            
            .text-sm {
                font-size: 0.875rem;
                line-height: 1.25rem;
            }
            
            .text-xs {
                font-size: 0.75rem;
                line-height: 1rem;
            }
            
            .font-bold {
                font-weight: 700;
            }
            
            .font-semibold {
                font-weight: 600;
            }
            
            .font-medium {
                font-weight: 500;
            }
            
            .text-white {
                color: white;
            }
            
            .text-gray-900 {
                color: #111827;
            }
            
            .text-gray-700 {
                color: #374151;
            }
            
            .text-gray-600 {
                color: #4b5563;
            }
            
            .text-gray-500 {
                color: #6b7280;
            }
            
            .text-gray-400 {
                color: #9ca3af;
            }
            
            .text-blue-600 {
                color: #2563eb;
            }
            
            .text-green-600 {
                color: #16a34a;
            }
            
            .text-red-600 {
                color: #dc2626;
            }
            
            .text-red-400 {
                color: #f87171;
            }
            
            .bg-gradient-to-br {
                background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
            }
            
            .from-blue-600 {
                --tw-gradient-from: #2563eb;
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(37, 99, 235, 0));
            }
            
            .to-purple-600 {
                --tw-gradient-to: #7c3aed;
            }
            
            .from-blue-500 {
                --tw-gradient-from: #3b82f6;
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(59, 130, 246, 0));
            }
            
            .to-blue-600 {
                --tw-gradient-to: #2563eb;
            }
            
            .from-green-500 {
                --tw-gradient-from: #22c55e;
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(34, 197, 94, 0));
            }
            
            .to-green-600 {
                --tw-gradient-to: #16a34a;
            }
            
            .from-purple-500 {
                --tw-gradient-from: #a855f7;
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(168, 85, 247, 0));
            }
            
            .to-purple-600 {
                --tw-gradient-to: #7c3aed;
            }
            
            .from-gray-100 {
                --tw-gradient-from: #f3f4f6;
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(243, 244, 246, 0));
            }
            
            .to-gray-200 {
                --tw-gradient-to: #e5e7eb;
            }
            
            .bg-gradient-to-r {
                background-image: linear-gradient(to right, var(--tw-gradient-stops));
            }
            
            .from-gray-900 {
                --tw-gradient-from: #111827;
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(17, 24, 39, 0));
            }
            
            .to-gray-700 {
                --tw-gradient-to: #374151;
            }
            
            .bg-clip-text {
                background-clip: text;
                -webkit-background-clip: text;
            }
            
            .text-transparent {
                color: transparent;
            }
            
            .group:hover .group-hover\:scale-110 {
                transform: scale(1.1);
            }
            
            .group:hover .group-hover\:text-blue-600 {
                color: #2563eb;
            }
            
            .group:hover .group-hover\:shadow-xl {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            
            .transition-all {
                transition-property: all;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 150ms;
            }
            
            .duration-200 {
                transition-duration: 200ms;
            }
            
            .transform {
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            }
            
            .hover\:-translate-y-0\.5:hover {
                --tw-translate-y: -0.125rem;
            }
            
            .hover\:-translate-y-1:hover {
                --tw-translate-y: -0.25rem;
            }
            
            .hover\:scale-110:hover {
                --tw-scale-x: 1.1;
                --tw-scale-y: 1.1;
            }
            
            .hover\:bg-gray-50:hover {
                background-color: #f9fafb;
            }
            
            .hover\:bg-gray-100:hover {
                background-color: #f3f4f6;
            }
            
            .hover\:bg-red-50:hover {
                background-color: #fef2f2;
            }
            
            .hover\:text-gray-600:hover {
                color: #4b7280;
            }
            
            .hover\:text-gray-900:hover {
                color: #111827;
            }
            
            .hover\:shadow-md:hover {
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
            
            .hover\:shadow-lg:hover {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
            
            .hover\:shadow-xl:hover {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            
            .focus\:outline-none:focus {
                outline: 2px solid transparent;
                outline-offset: 2px;
            }
            
            .focus\:ring-2:focus {
                box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
            }
            
            .focus\:ring-blue-500:focus {
                box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
            }
            
            .focus\:ring-gray-500:focus {
                box-shadow: 0 0 0 2px rgba(107, 114, 128, 0.5);
            }
            
            .focus\:ring-offset-2:focus {
                box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
            }
            
            .focus\:border-blue-500:focus {
                border-color: #3b82f6;
            }
            
            .border {
                border-width: 1px;
            }
            
            .border-gray-100 {
                border-color: #f3f4f6;
            }
            
            .border-gray-200 {
                border-color: #e5e7eb;
            }
            
            .border-gray-300 {
                border-color: #d1d5db;
            }
            
            .border-t {
                border-top-width: 1px;
            }
            
            .border-l-4 {
                border-left-width: 4px;
            }
            
            .overflow-hidden {
                overflow: hidden;
            }
            
            .overflow-y-auto {
                overflow-y: auto;
            }
            
            .h-full {
                height: 100%;
            }
            
            .w-full {
                width: 100%;
            }
            
            .w-px {
                width: 1px;
            }
            
            .h-px {
                height: 1px;
            }
            
            .h-8 {
                height: 2rem;
            }
            
            .mx-auto {
                margin-left: auto;
                margin-right: auto;
            }
            
            .mx-2 {
                margin-left: 0.5rem;
                margin-right: 0.5rem;
            }
            
            .mx-3 {
                margin-left: 0.75rem;
                margin-right: 0.75rem;
            }
            
            .mr-2 {
                margin-right: 0.5rem;
            }
            
            .mr-3 {
                margin-right: 0.75rem;
            }
            
            .ml-3 {
                margin-left: 0.75rem;
            }
            
            .ml-4 {
                margin-left: 1rem;
            }
            
            .mb-3 {
                margin-bottom: 0.75rem;
            }
            
            .mb-4 {
                margin-bottom: 1rem;
            }
            
            .mb-6 {
                margin-bottom: 1.5rem;
            }
            
            .mb-8 {
                margin-bottom: 2rem;
            }
            
            .mb-12 {
                margin-bottom: 3rem;
            }
            
            .mt-1 {
                margin-top: 0.25rem;
            }
            
            .mt-2 {
                margin-top: 0.5rem;
            }
            
            .mt-4 {
                margin-top: 1rem;
            }
            
            .mt-6 {
                margin-top: 1.5rem;
            }
            
            .mt-8 {
                margin-top: 2rem;
            }
            
            .my-1 {
                margin-top: 0.25rem;
                margin-bottom: 0.25rem;
            }
            
            .p-2 {
                padding: 0.5rem;
            }
            
            .p-4 {
                padding: 1rem;
            }
            
            .p-6 {
                padding: 1.5rem;
            }
            
            .px-3 {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            
            .px-4 {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
            
            .py-2 {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }
            
            .py-3 {
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
            }
            
            .py-4 {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }
            
            .py-16 {
                padding-top: 4rem;
                padding-bottom: 4rem;
            }
            
            .pt-6 {
                padding-top: 1.5rem;
            }
            
            .pt-20 {
                padding-top: 5rem;
            }
            
            .pb-4 {
                padding-bottom: 1rem;
            }
            
            .space-x-2 > :not([hidden]) ~ :not([hidden]) {
                margin-left: 0.5rem;
            }
            
            .space-x-3 > :not([hidden]) ~ :not([hidden]) {
                margin-left: 0.75rem;
            }
            
            .space-x-4 > :not([hidden]) ~ :not([hidden]) {
                margin-left: 1rem;
            }
            
            .space-y-3 > :not([hidden]) ~ :not([hidden]) {
                margin-top: 0.75rem;
            }
            
            .space-y-4 > :not([hidden]) ~ :not([hidden]) {
                margin-top: 1rem;
            }
            
            .space-y-6 > :not([hidden]) ~ :not([hidden]) {
                margin-top: 1.5rem;
            }
            
            .space-y-8 > :not([hidden]) ~ :not([hidden]) {
                margin-top: 2rem;
            }
            
            .flex {
                display: flex;
            }
            
            .inline-flex {
                display: inline-flex;
            }
            
            .grid {
                display: grid;
            }
            
            .hidden {
                display: none;
            }
            
            .items-center {
                align-items: center;
            }
            
            .items-start {
                align-items: flex-start;
            }
            
            .justify-center {
                justify-content: center;
            }
            
            .justify-between {
                justify-content: space-between;
            }
            
            .justify-end {
                justify-content: flex-end;
            }
            
            .text-center {
                text-align: center;
            }
            
            .text-right {
                text-align: right;
            }
            
            .relative {
                position: relative;
            }
            
            .absolute {
                position: absolute;
            }
            
            .fixed {
                position: fixed;
            }
            
            .inset-0 {
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
            }
            
            .right-0 {
                right: 0;
            }
            
            .top-20 {
                top: 5rem;
            }
            
            .mt-2 {
                margin-top: 0.5rem;
            }
            
            .w-56 {
                width: 14rem;
            }
            
            .w-96 {
                width: 24rem;
            }
            
            .max-w-2xl {
                max-width: 42rem;
            }
            
            .max-w-4xl {
                max-width: 56rem;
            }
            
            .max-w-7xl {
                max-width: 80rem;
            }
            
            .w-4\/5 {
                width: 80%;
            }
            
            .grid-cols-1 {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
            
            .md\:grid-cols-2 {
                @media (min-width: 768px) {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }
            
            .md\:grid-cols-3 {
                @media (min-width: 768px) {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
            }
            
            .lg\:grid-cols-2 {
                @media (min-width: 1024px) {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }
            
            .lg\:grid-cols-3 {
                @media (min-width: 1024px) {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
            }
            
            .gap-6 {
                gap: 1.5rem;
            }
            
            .gap-8 {
                gap: 2rem;
            }
            
            .col-span-full {
                grid-column: 1 / -1;
            }
            
            .cursor-pointer {
                cursor: pointer;
            }
            
            .cursor-not-allowed {
                cursor: not-allowed;
            }
            
            .select-none {
                user-select: none;
            }
            
            .resize-none {
                resize: none;
            }
            
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            
            .inline {
                display: inline;
            }
            
            .block {
                display: block;
            }
            
            .flex-1 {
                flex: 1 1 0%;
            }
            
            .flex-shrink-0 {
                flex-shrink: 0;
            }
            
            .flex-grow {
                flex-grow: 1;
            }
            
            .bg-white {
                background-color: white;
            }
            
            .bg-gray-50 {
                background-color: #f9fafb;
            }
            
            .bg-gray-100 {
                background-color: #f3f4f6;
            }
            
            .bg-gray-200 {
                background-color: #e5e7eb;
            }
            
            .bg-blue-100 {
                background-color: #dbeafe;
            }
            
            .bg-green-100 {
                background-color: #dcfce7;
            }
            
            .bg-red-100 {
                background-color: #fee2e2;
            }
            
            .bg-green-50 {
                background-color: #f0fdf4;
            }
            
            .bg-red-50 {
                background-color: #fef2f2;
            }
            
            .bg-gradient-to-br {
                background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
            }
            
            .from-gray-50 {
                --tw-gradient-from: #f9fafb;
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(249, 250, 251, 0));
            }
            
            .via-white {
                --tw-gradient-to: rgba(255, 255, 255, 0);
                --tw-gradient-stops: var(--tw-gradient-from), #ffffff, var(--tw-gradient-to);
            }
            
            .to-gray-100 {
                --tw-gradient-to: #f3f4f6;
            }
            
            .min-h-screen {
                min-height: 100vh;
            }
            
            .min-h-screen {
                min-height: 100vh;
            }
            
            .py-8 {
                padding-top: 2rem;
                padding-bottom: 2rem;
            }
            
            .px-4 {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .sm\:px-6 {
                @media (min-width: 640px) {
                    padding-left: 1.5rem;
                    padding-right: 1.5rem;
                }
            }
            
            .lg\:px-8 {
                @media (min-width: 1024px) {
                    padding-left: 2rem;
                    padding-right: 2rem;
                }
            }
            
            /* Gradient backgrounds */
            .bg-gradient-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            
            .bg-gradient-secondary {
                background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            }
            
            .bg-gradient-success {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            }
            
            /* Modern animations */
            .animate-fade-in {
                animation: fadeIn 0.5s ease-in-out;
            }
            
            .animate-slide-up {
                animation: slideUp 0.5s ease-out;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            
            @keyframes slideUp {
                from { 
                    opacity: 0;
                    transform: translateY(20px);
                }
                to { 
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            /* Modern button styles */
            .btn-modern {
                padding: 0.75rem 1.5rem;
                border-radius: 0.75rem;
                font-weight: 600;
                font-size: 0.875rem;
                transition: all 0.2s ease;
                transform: translateY(0);
                outline: none;
                border: none;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
            
            .btn-modern:hover {
                transform: translateY(-2px);
            }
            
            .btn-modern:focus {
                box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
            }
            
            .btn-primary-modern {
                background: linear-gradient(to right, #2563eb, #7c3aed);
                color: white;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
            
            .btn-primary-modern:hover {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            
            .btn-secondary-modern {
                background: white;
                color: #374151;
                border: 1px solid #d1d5db;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            }
            
            .btn-secondary-modern:hover {
                background: #f9fafb;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
            
            /* Card styles */
            .card-modern {
                background: white;
                border-radius: 1rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                border: 1px solid #f3f4f6;
                overflow: hidden;
            }
            
            .card-modern-hover {
                transition: all 0.2s ease;
            }
            
            .card-modern-hover:hover {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                transform: translateY(-4px);
            }
            
            /* Input styles */
            .input-modern {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 1px solid #d1d5db;
                border-radius: 0.75rem;
                background: white;
                transition: all 0.2s ease;
                outline: none;
            }
            
            .input-modern:focus {
                border-color: #3b82f6;
                box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                transform: translateY(-2px);
            }
            
            /* Navigation styles */
            .nav-link {
                display: flex;
                align-items: center;
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
                font-weight: 500;
                color: #4b5563;
                border-radius: 0.5rem;
                transition: all 0.2s ease;
                text-decoration: none;
            }
            
            .nav-link:hover {
                color: #111827;
                background: #f9fafb;
                transform: translateY(-2px);
            }
            
            /* Enhanced alerts */
            .alert-modern {
                border-radius: 0.75rem;
                border-left: 4px solid;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
            
            .alert-success {
                background: #f0fdf4;
                border-color: #4ade80;
                color: #166534;
            }
            
            .alert-error {
                background: #fef2f2;
                border-color: #f87171;
                color: #991b1b;
            }
            
            /* Page transitions */
            .page-content {
                animation: fadeIn 0.5s ease-in-out;
            }
            
            /* Modern background */
            .bg-modern {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            }
            
            .bg-modern-alt {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
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
        <!-- Modern Navigation -->
        <nav class="bg-white/80 backdrop-blur-md shadow-modern-lg border-b border-gray-100 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="{{ route('forms.index') }}" class="flex items-center space-x-3 group">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
                                    FormBuilder
                                </h1>
                                <p class="text-xs text-gray-500 font-medium">Create Amazing Forms</p>
                            </div>
                        </a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('forms.index') }}" class="nav-link group">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Forms
                        </a>
                        <a href="{{ route('templates.index') }}" class="nav-link group">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Templates
                        </a>
                        <a href="{{ route('activity-logs.index') }}" class="nav-link group">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Activity
                        </a>
                        <div class="h-8 w-px bg-gray-200 mx-2"></div>
                        <a href="{{ route('forms.create') }}" class="btn-modern btn-primary-modern flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create Form
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                @if(session('success'))
                    <div class="mb-6 alert-modern alert-success px-6 py-4 animate-slide-up">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-semibold">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 alert-modern alert-error px-6 py-4 animate-slide-up">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-semibold">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <div class="page-content">
                    @yield('content')
                </div>
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

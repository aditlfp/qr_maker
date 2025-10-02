<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @auth
                        {{ __('Hello') }}, {{ Auth::user()->name }}!
                    @else
                        {{ __('Hello, Guest!') }}
                    @endauth
                    {{ __('Wellcome Back!') }}
                </div>
            </div>
            <div class="bg-gray-200 overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-2 text-gray-500 text-sm text-center">
                    @if ($lastModifiedTime)
                        <p>
                            Last Updated At : {{ $lastModifiedTime->format('M d, Y H:i:s') }} - V1.0.0
                        </p>
                    @else
                        <p>No files found.</p>
                    @endif
                </div>
            </div>
        </div>
</x-app-layout>

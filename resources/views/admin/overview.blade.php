<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin / Overview') }}
        </h2>

        <a href="{{ route('dashboard') }}"
            class="text-sm text-gray-600 hover:underline">
            ← Back to Dashboard
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <div class="bg-white p-6 rounded shadow">
                    <div class="text-gray-500 text-sm">Users</div>
                    <div class="text-2xl font-bold">{{ $total_users }}</div>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <div class="text-gray-500 text-sm">Short URLs</div>
                    <div class="text-2xl font-bold">{{ $total_urls }}</div>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <div class="text-gray-500 text-sm">Total Clicks</div>
                    <div class="text-2xl font-bold">{{ $total_clicks }}</div>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <div class="text-gray-500 text-sm">Today URLs</div>
                    <div class="text-2xl font-bold">{{ $today_urls }}</div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

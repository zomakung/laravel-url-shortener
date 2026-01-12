<x-app-layout>
    <div x-data="{ openCreateModal: false }">

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        
                        <div class="py-6">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white shadow-sm sm:rounded-lg">

                                    <div class="flex justify-between items-center mb-6">
                                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                            {{ __('My Shortened URLs') }}
                                        </h2>
                                        <button @click="openCreateModal = true" class="inline-flex items-center px-4 py-2 bg-black text-white text-sm rounded-md hover:bg-gray-800">
                                            + New URL
                                        </button>
                                    </div>

                                    <table class="w-full text-sm border-t">
                                        <thead class="text-left text-gray-500">
                                            <tr>
                                                <th class="p-2">Original URL</th>
                                                <th class="p-2">Short URL</th>
                                                <th class="p-2 text-center">Clicks</th>
                                                <th class="p-2">Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($urls as $url)
                                                <tr class="border-t">
                                                    <td class="p-2 truncate max-w-xs">
                                                        {{ $url->original_url }}
                                                    </td>
                                                    <td class="p-2 flex items-center gap-2">
                                                        <div x-data="{ copied: false }" class="flex items-center gap-2 relative w-full max-w-xs">
                                                            <input
                                                                type="text"
                                                                readonly
                                                                value="{{ url($url->short_code) }}"
                                                                @dblclick="
                                                                    $event.target.select();
                                                                    navigator.clipboard.writeText($event.target.value);
                                                                    copied = true;
                                                                    setTimeout(() => copied = false, 1500);
                                                                "
                                                                class="w-full text-sm border border-gray-300 rounded px-2 py-1 cursor-pointer bg-gray-50 focus:outline-none"
                                                                title="Double click to copy">

                                                            <button
                                                                type="button"
                                                                @click="
                                                                    navigator.clipboard.writeText('{{ url($url->short_code) }}');
                                                                    copied = true;
                                                                    setTimeout(() => copied = false, 1500);
                                                                "
                                                                class="text-gray-400 hover:text-black transition"
                                                                title="Copy URL">
                                                                
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none"
                                                                    viewBox="0 0 24 24"
                                                                    stroke-width="1.5"
                                                                    stroke="currentColor"
                                                                    class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M8.25 7.5V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0120.25 6v7.5A2.25 2.25 0 0118 15.75h-1.5M8.25 7.5H6A2.25 2.25 0 003.75 9.75v7.5A2.25 2.25 0 006 19.5h7.5A2.25 2.25 0 0015.75 17.25v-7.5A2.25 2.25 0 0013.5 7.5H8.25z"/>
                                                                </svg>
                                                            </button>

                                                            <span
                                                                x-show="copied"
                                                                x-transition
                                                                class="absolute -top-7 right-0 text-xs bg-black text-white px-2 py-1 rounded">
                                                                Copied!
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="p-2 text-center">{{ $url->clicks }}</td>
                                                    <td class="p-2">{{ $url->created_at->format('Y-m-d H:i:s') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="p-4 text-center text-gray-500">
                                                        No URLs found.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <div class="mt-6 pb-6">
                                        {{ $urls->links() }}
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="openCreateModal"
            x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
            @click.self="openCreateModal = false"
            x-cloak>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Create New Short URL
                </h3>

                <form method="POST" action="{{ route('shorten') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Original URL
                        </label>
                        <input
                            type="url"
                            name="original_url"
                            required
                            placeholder="https://example.com"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black">
                    </div>

                    <div class="flex justify-end gap-2">
                        <button
                            type="button"
                            @click="openCreateModal = false"
                            class="px-4 py-2 text-sm border rounded-md">
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="px-4 py-2 text-sm bg-black text-white rounded-md hover:bg-gray-800">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>

<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin / URLs') }}
            </h2>

            <a href="{{ route('dashboard') }}"
               class="text-sm text-gray-600 hover:underline">
                ← Back to Dashboard
            </a>
        </div>
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
                                        {{ __('Shortened URLs') }}
                                    </h2>
                                </div>

                                <table class="w-full text-sm border-t">
                                    <thead class="text-left text-gray-500">
                                        <tr>
                                            <th class="p-2">User</th>
                                            <th class="p-2">Original URL</th>
                                            <th class="p-2">Short URL</th>
                                            <th class="p-2 text-center">Clicks</th>
                                            <th class="p-2">Created</th>
                                            <th class="text-right p-2">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($urls as $url)
                                            <tr class="border-t">
                                                <td class="p-2">
                                                    {{ $url->user->email }}
                                                </td>
                                                <td class="p-2 truncate max-w-xs">
                                                    {{ $url->original_url }}
                                                </td>
                                                <td class="p-2">
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
                                                            class="w-full text-sm border border-gray-300 rounded px-2 py-1
                                                                cursor-pointer bg-gray-50 focus:outline-none"
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
                                                <td class="p-2 text-right">
                                                    <form method="POST"
                                                        action="{{ route('admin.urls.destroy', $url) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this URL?')">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="text-gray-400 hover:text-red-600 transition"
                                                            title="Delete URL">

                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke-width="1.5"
                                                                stroke="currentColor"
                                                                class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="p-6 text-center text-gray-500">
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

</x-app-layout>
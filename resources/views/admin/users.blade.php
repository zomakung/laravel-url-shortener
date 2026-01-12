<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin / Users') }}
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
                                        {{ __('Shortened users') }}
                                    </h2>
                                </div>

                                <table class="w-full text-sm border-t">
                                    <thead class="text-left text-gray-500">
                                        <tr>
                                            <th class="p-2">Name</th>
                                            <th class="p-2">Email</th>
                                            <th class="p-2">Role</th>
                                            <th class="p-2 text-center">URLs count</th>
                                            <th class="p-2">Joined at</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr class="border-t">
                                                <td class="p-2">{{ $user->name }}</td>
                                                <td class="p-2">{{ $user->email }}</td>
                                                <td class="p-2">
                                                    @if($user->isAdmin())
                                                        <span class="text-xs bg-black text-white px-2 py-1 rounded">Admin</span>
                                                    @else
                                                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">User</span>
                                                    @endif
                                                </td>
                                                <td class="p-2 text-center">{{ $user->short_urls_count }}</td>
                                                <td class="p-2">{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="p-6 text-center text-gray-500">
                                                    No users found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="mt-6 pb-6">
                                    {{ $users->links() }}
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
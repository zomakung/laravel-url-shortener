@props(['active'])

<a {{ $attributes->merge([
    'class' => ($active ?? false)
        ? 'inline-flex items-center h-16 px-3 border-b-2 border-black text-sm font-medium text-gray-900'
        : 'inline-flex items-center h-16 px-3 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300'
]) }}>
    {{ $slot }}
</a>
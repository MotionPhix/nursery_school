<x-splade-component is="dropdown" {{ $attributes->class('w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm px-2 py-2 inline-flex justify-center text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500') }}>
    <x-slot:trigger>
        {{ $button }}
    </x-slot:trigger>

    <div class="mt-2 bg-white dark:bg-gray-500 dark:text-white rounded-md shadow-lg min-w-max ring-1 ring-black ring-opacity-5">
        {{ $slot }}
    </div>
</x-splade-component>

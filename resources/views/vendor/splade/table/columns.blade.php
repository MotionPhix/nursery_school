<x-splade-component is="button-with-dropdown" dusk="columns-dropdown">
    <x-slot:button>
        <span
        :class="{
            'text-gray-400': !table.columnsAreToggled,
            'text-green-400': table.columnsAreToggled,
        }">
        <x-tabler-filter
            class="w-5 h-5" />
        </span>
    </x-slot:button>

    <div class="px-2">
        <ul class="divide-y divide-gray-200">
            @foreach($table->columns() as $column)
                @if(!$column->canBeHidden)
                    @continue
                @endif

                <li class="flex items-center justify-between py-2">
                    <p class="text-sm text-gray-900">
                        {{ $column->label }}
                    </p>

                    <button
                        type="button"
                        class="relative inline-flex flex-shrink-0 h-6 ml-4 transition-colors duration-300 ease-in-out border-2 border-transparent rounded-full cursor-pointer w-11 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-light-blue-500"
                        :class="{
                            'bg-green-500': table.columnIsVisible(@js($column->key)),
                            'bg-gray-200': !table.columnIsVisible(@js($column->key)),
                        }"
                        :aria-pressed="table.columnIsVisible(@js($column->key))"
                        aria-labelledby="toggle-column-{{ $column->key }}"
                        aria-describedby="toggle-column-{{ $column->key }}"
                        @click.prevent="table.toggleColumn(@js($column->key))"
                        dusk="toggle-column-{{ $column->key }}"
                    >
                        <span class="sr-only">Column status</span>
                        <span
                            aria-hidden="true"
                            :class="{
                                'translate-x-5': table.columnIsVisible(@js($column->key)),
                                'translate-x-0': !table.columnIsVisible(@js($column->key)),
                            }"
                            class="inline-block w-5 h-5 transition duration-300 ease-in-out transform bg-white rounded-full shadow ring-0" />
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
</x-splade-component>

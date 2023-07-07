<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Grades') }}
    </h2>

    <span class="flex-1"></span>

    <x-splade-link
      href="{{ route('grades.create') }}"
      class="flex items-center gap-2 font-bold"
      modal>
      <x-tabler-plus class="h-5" /> <span>Add grade</span>
    </x-splade-link>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          @forelse ($grades as $grade)
            <x-splade-link
              href="{{ route('grades.show', $grade->id) }}">
              {{ $grade->name }}
            </x-splade-link>
          @empty
            <p>
              <strong>Hmm!</strong> <br>
              <span>Kind of looks too empty here</span> <br>
            </p>
          @endforelse

        </div>
      </div>
    </div>
  </div>
</x-app-layout>

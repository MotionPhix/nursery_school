<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Grades') }}
    </h2>

    <span class="flex-1"></span>

    @if($grades->count())
      <x-splade-link
        href="{{ route('grades.create') }}"
        class="flex items-center gap-2 font-bold"
        modal>
        <x-tabler-plus class="h-5" /> <span>Add grade</span>
      </x-splade-link>
    @endif

  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          <section class="grid grid-cols-4">
          @forelse ($grades as $grade)
          <x-splade-link
            href="{{ route('grades.show', $grade->id) }}"
            class="group relative block h-40 sm:h-60 lg:h-64">
            <span class="absolute inset-0 border-2 border-dashed border-black"></span>

            <div
              class="relative flex h-full transform items-end border-2 border-black bg-white transition-transform group-hover:-translate-x-2 group-hover:-translate-y-2"
            >
              <div
                class="p-4 !pt-0 transition-opacity group-hover:absolute group-hover:opacity-0 sm:p-6 lg:p-8"
              >
                <x-tabler-books
                  class="h-10 w-10 sm:h-12 sm:w-12 stroke-1" />

                <h2 class="mt-4 text-xl font-medium sm:text-2xl">{{ $grade->name }}</h2>
              </div>

              <div
                class="absolute p-4 opacity-0 transition-opacity group-hover:relative group-hover:opacity-100 sm:p-6 lg:p-8"
              >
                <h3 class="mt-4 text-xl font-medium sm:text-2xl">{{ $grade->name }}</h3>

                <p class="mt-4 text-sm sm:text-base">
                  {{ $grade->description }}
                </p>

                <p class="mt-8 font-bold">See grade</p>
              </div>
            </div>
          </x-splade-link>

            {{-- <div class="flex flex-col bg-white dark:bg-gray-800 rounded-lg shadow-lg h-52">
              <div class="w-full flex-1" />

              <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white border-b pb-4">
                  {{ $grade->name }}
                </h2>

                <div class="mt-4 flex items-center justify-end gap-2">
                  <x-splade-link
                    class="inline-block bg-blue-200 px-2 py-2 text-blue-800 p-1 rounded">
                    <x-tabler-trash class="w-5 h-5" />
                  </x-splade-link>

                  <x-splade-link
                    class="bg-blue-200 hover:bg-opacity-75 text-blue-800 px-2 py-2 text-sm font-bold rounded flex items-center gap-2"
                    href="{{ route('grades.show', $grade->id) }}">
                    <span>See grade</span> <x-tabler-arrow-right class="w-5 h-5" />
                  </x-splade-link>
                </div>
              </div>
            </div> --}}

          @empty
            <div class="p-12 text-center col-span-4">
              <x-tabler-books class="stroke-current stroke-1 w-16 h-16 mx-auto mb-7" />

              <h3 class="mb-3 text-lg font-semibold font-heading">
                Add a grade
              </h3>

              <p class="max-w-sm mx-auto mb-7 text-neutral-500">
                Create a grade (Class) for your your school. Grades will remain the same overtime as
                students graduate to different grades.
              </p>

                <x-splade-link class="inline-flex flex-wrap items-center justify-center px-6 py-2.5 text-sm border hover:border-neutral-200 rounded-lg"
                  href="{{ route('grades.create') }}"
                  modal>
                  <x-tabler-plus class="mr-2.5 h-5" />

                  <span class="font-medium" data-config-id="auto-txt-6-3">Create A Grade</span>
                </x-splade-link>
            </div>
          @endforelse
        </section>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>

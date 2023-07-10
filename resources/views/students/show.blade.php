@seoTitle(__('School Management | Student data'))

<x-app-layout>
  <x-slot name="header">
    <x-splade-link
      class="text-xl font-semibold leading-tight text-gray-800"
      href="{{ route('grades.index') }}">
      {{ __('Students') }}
    </x-splade-link>

    <x-tabler-chevron-right class="h-5 text-gray-500" />

    {{ $student->first_name . ' ' . $student->last_name }}

    <span class="flex-1"></span>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          <x-students.student-detail :student="$student" />

        </div>
      </div>
    </div>
  </div>
</x-app-layout>

@seoTitle(__('School Management | Grade data'))

<x-app-layout>
  <x-slot name="header">
    <x-splade-link
      class="text-xl font-semibold leading-tight text-gray-800"
      href="{{ route('grades.index') }}">
      {{ __('Grades') }}
    </x-splade-link>

    <x-tabler-chevron-right class="h-5 text-gray-500" />

    {{ $grade->name }}

    <span class="flex-1"></span>

    @if ($grade->students->count())

      <x-splade-link
        href="{{ route('students.create', $grade->id) }}"
        class="flex items-center gap-2 font-bold"
        modal>
        <x-tabler-user-plus class="h-5" /> <span>Add student</span>
      </x-splade-link>

    @endif

  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          @if($students)

            <x-splade-table
              :for="$students"
              class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
              pagination-scroll="preserve">

              <x-slot name="head">

                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                  <tr>

                    @foreach($students->columns() as $column)

                      <th scope="col" class="px-6 py-3">{{ $column->label }}</th>

                    @endforeach

                  </tr>

                </thead>

              </x-slot>

              <x-slot name="body">

                <tbody>

                  @foreach($students->resource as $student)

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $student->first_name }}
                      </th>

                      <td class="px-6 py-4">
                        {{ $student->last_name }}
                      </td>

                      <td class="px-6 py-4">
                        {{ $student->birthday }}
                      </td>

                      <td class="px-6 py-4">
                        {{ $student->age }} year{{ $student->age > 1 ? 's' : '' }} old
                      </td>

                      <td class="px-6 py-4">
                        {{ $student->guardian->first_name . ' ' . $student->guardian->last_name }}
                      </td>

                      <td class="px-6 py-4">
                        <x-splade-link
                          href="/students/{{ $student->id }}"
                          class="flex items-center gap-2 text-right">
                          <x-tabler-pencil class="w-5 h-5" /> <span>See student</span>
                        </x-splade-link>
                      </td>

                    </tr>

                  @endforeach

                </tbody>

              </x-slot>

              <x-slot:empty-state>
                <div class="p-12 text-center">
                  <x-tabler-user-plus class="w-16 h-16 mx-auto mb-7" />

                  <h3 class="mb-3 text-lg font-semibold font-heading">
                    Add your first student
                  </h3>

                  <p class="max-w-sm mx-auto mb-7 text-neutral-500">
                    Create a student for your <strong>{{ $grade->name }}</strong> and the student will appear in the list above.</p>

                    <x-splade-link class="inline-flex flex-wrap items-center justify-center px-6 py-2.5 text-sm border hover:border-neutral-200 rounded-lg"
                      href="{{ route('students.create', $grade) }}"
                      modal>
                      <x-tabler-plus class="mr-2.5 h-5" />

                      <span class="font-medium" data-config-id="auto-txt-6-3">Add A Student</span>
                    </x-splade-link>
                </div>
              </x-slot>

            </x-splade-table>

          @else

            <div class="p-12 text-center">
              <x-tabler-user-plus class="w-16 h-16 mx-auto mb-7" />

              <h3 class="mb-3 text-lg font-semibold font-heading">
                Add your first student
              </h3>

              <p class="max-w-sm mx-auto mb-7 text-neutral-500">
                Create a student for your <strong>{{ $grade->name }}</strong> and the student will appear in the list above.</p>

                <x-splade-link class="inline-flex flex-wrap items-center justify-center px-6 py-2.5 text-sm border hover:border-neutral-200 rounded-lg"
                  href="{{ route('students.create', $grade) }}"
                  modal>
                  <x-tabler-plus class="mr-2.5 h-5" />

                  <span class="font-medium" data-config-id="auto-txt-6-3">Add A Student</span>
                </x-splade-link>
            </div>

          @endif

        </div>
      </div>
    </div>
  </div>
</x-app-layout>

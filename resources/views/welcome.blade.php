<x-guest-layout>

  <div class="flex justify-between items-center p-6">

    <x-splade-link href="{{ route('users.create') }}" class="flex gap-2 items-center" modal>
      <x-tabler-user /> <span>Add user</span>
    </x-splade-link>

    <Switch />

  </div>

  <div class="grid max-w-6xl grid-cols-1 gap-10 py-10 mx-auto font-sans">

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

            </tr>

          @endforeach

        </tbody>

      </x-slot>

      <x-slot:empty-state>
        <p>Whoops!</p>
      </x-slot>

    </x-splade-table>

  </div>

</x-guest-layout>

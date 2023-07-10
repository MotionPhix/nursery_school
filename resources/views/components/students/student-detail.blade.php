@props(['student'])

@php
  $classMap = [
    'available' => 'bg-green-100 text-green-800',
    'inactive' => 'bg-red-100 text-red-800',
  ];
@endphp

<div class="grid grid-cols-3 gap-10">
  <section>

    <img
      class="w-full mb-8 rounded-lg"
      src="{{
        'https://via.placeholder.com/350x200.png?text=No+Image'
      }}"
      alt="Image of {{ $student->first_name }} {{ $student->last_name }}"/>

      {{-- $student->avatar->count() > 0
          ? $student->avatar->random()->full_path
          :  --}}

    <h1 class="self-start max-w-xl mb-4 text-4xl font-thin js-sticky-widget">
      {{ $student->first_name . ' ' . $student->last_name }}
    </h1>

    <div class="flex gap-4 pt-4 itemx-center">
      <span class="{{ $classMap[$student->status] ?? 'bg-blue-100 text-blue-800' }} px-2 py-1 inline-flex capitalize text-lg font-semibold rounded-md">
        {{ $student->status }}
      </span>

      <span class="inline-flex px-2 py-1 text-lg font-semibold capitalize bg-red-100 rounded-md">
        Delete
      </span>
    </div>
  </section>

  <section class="col-span-2">

    <div class="grid w-full grid-cols-1 gap-8 md:grid-cols-2">
      <div class="flex flex-col gap-4 divide-y col-span-2">
        <h2 class="pb-2 text-xl font-semibold">Details</h2>

        <p class="pt-4">
          <strong class="block">First name:</strong>
          <span class="block">{{ $student->first_name }}</span>
        </p>

        <p class="pt-4">
          <strong class="block">Last name:</strong>
          <span class="block">{{ $student->last_name }}</span>
        </p>

        {{-- <p class="pt-4"><strong class="block">Country:</strong> <span class="block">{{ $student->township->city->country->name }}</span></p> --}}
        {{-- <p class="pt-4"><strong class="block">Size:</strong> <span class="block">{{ $student->size }} sqm</span></p> --}}
        {{-- <p class="pt-4"><strong class="block">Price:</strong> <span class="block">{{ formatCurrency($student->price) }}/month</span></p> --}}

        <p class="pt-4">
          <strong class="block">
            Biography:
          </strong>

          <span class="block mt-4">
            {!! $student->biography !!}
          </span>
        </p>

      </div>

      {{-- <div>
        <h2 class="mb-2 text-xl font-semibold">Location map</h2>
        <div class="h-[30em] pt-4">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2436.088383788924!2d-0.1277586844498615!3d51.507350597927634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604e1dd6b8d61%3A0x52963a5addd52a99!2sBig%20Ben!5e0!3m2!1sen!2sus!4v1620824784612!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div> --}}
    </div>

    <div class="w-full py-10">
      <h2 class="pb-4 mb-4 text-xl font-semibold border-b">
        Grade history
      </h2>

      <div class="flex flex-col gap-2 pt-8">
        @foreach ($student->grades as $grade)

          <div class="flex flex-col p-4 bg-gray-100 gap-4 rounded-md">
            <section
              class="w-32">
              <span class="block text-gray-600 font-thin text-2xl">
                {{ $grade->name }}
              </span>
            </section>

            <span class="border-t border-rose-400 block" />

            <section class="flex items-center gap-4">
              <span class="block text-gray-400 font-bold">
                School year:
              </span>

              <span class="block text-gray-700">
                {{ \App\Models\SchoolYear::find($grade->pivot->school_year_id)->year }}
              </span>

              <span class="flex-1" />

              <span class="block text-gray-400 font-bold">
                Enrollment date:
              </span>

              <span class="block text-gray-500">
                {{ $grade->pivot->enrollment_date }}
              </span>
            </section>
          </div>

        @endforeach
      </div>
    </div>

  </section>
</div>

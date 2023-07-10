<x-splade-modal
  close-explicitly
  :close-button="false"
  position="top"
  max-width="2xl">

  <!-- Modal content -->
  <div class="relative p-4 sm:p-5">

    <!-- Modal header -->
    <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t sm:mb-5 dark:border-gray-600">

      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
        Add student
      </h3>

      <button
        type="button"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
        @click="modal.close">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close modal</span>
      </button>

    </div>

    <!-- Modal body -->
    <x-splade-form
      :action="route('students.store', $grade)"
      autocomplete="off"
      class="space-y-6">

      <div
        class="grid grid-cols-2 gap-2">
        <x-splade-input
          id="first_name"
          placeholder="Enter student's first name"
          :label="__('First name')"
          name="first_name"
          type="text"
          autofocus />

        <x-splade-input
          id="last_name"
          placeholder="Enter student's last name"
          :label="__('Last name')"
          name="last_name"
          type="text"   />
      </div>

      <div
        class="grid grid-cols-2 gap-2">


        <x-splade-rehydrate
          on="guardian-added">
          <x-splade-select
            name="user_id"
            placeholder="Pick a guardian for the student"
            :label="__('Guardian')"
            remote-url="/guardians"
            option-label="name"
            option-value="id"
            choices />
        </x-splade-rehydrate>

        <x-splade-rehydrate
          on="school-year-added">
          <x-splade-select
            name="school_year_id"
            placeholder="Pick student's year of enrollment"
            :label="__('School year')"
            remote-url="/school-years"
            option-label="year"
            option-value="id"
            choices />
        </x-splade-rehydrate>
      </div>

      <x-splade-input
        id="birthday"
        placeholder="Provide student's birth date"
        :label="__('Date of birth')"
        name="birthday"
        date  />

      <x-splade-wysiwyg
        label="Bio"
        placeholder="Information related to the student e.g. allergies, etc"
        jodit="{ showXPathInStatusbar: true }"
        name="biography" />

      <div class="flex items-center justify-between">

        <section
          class="flex items-center gap-4">

          <x-splade-link
            href="{{ route('guardians.create') }}"
            class="flex items-center gap-2 bg-gray-200 px-2 py-1.5 font-bold rounded hover:bg-gray-300 transition-colors duration-500 hover:text-lime-800"
            modal>
            <x-tabler-user-plus class="h-5 w-5" /> <span>Add parent</span>
          </x-splade-link>

          <x-splade-link
            href="{{ route('schoolyears.create') }}"
            class="flex items-center gap-2 bg-gray-200 px-2 py-1.5 font-bold rounded hover:bg-gray-300  transition-colors duration-500 hover:text-lime-800"
            modal>
            <x-tabler-plus class="h-5 w-5" /> <span>Add school year</span>
          </x-splade-link>

        </section>

        <x-splade-submit
          class="ml-4 bg-lime-500 hover:bg-opacity-75"
          :label="__('Create')" />

      </div>

    </x-splade-form>

  </div>

</x-splade-modal>

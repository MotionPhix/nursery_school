<x-splade-modal
  close-explicitly
  :close-button="false"
  position="top"
  max-width="lg">

  <!-- Modal content -->
  <div class="relative p-4 sm:p-5">

    <!-- Modal header -->
    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">

      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
        Add grade
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
      :action="route('grades.store')"
      autocomplete="off"
      class="space-y-6">

      <x-splade-input
        autofocus
        id="name"
        type="text"
        name="name"
        :label="__('Name')"
        placeholder="Enter grade name e.g 'Elementary'"
        autocomplete="off" />

      <x-splade-textarea
        label="Description"
        placeholder="Describe the grade a little bit"
        name="description"
        autosize />

      <div class="flex items-center justify-end">
        <x-splade-submit
          class="ml-4 bg-lime-500 hover:bg-opacity-75"
          :label="__('Create')" />
      </div>

  </x-splade-form>

  </div>

</x-splade-modal>

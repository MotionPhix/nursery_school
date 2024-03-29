<x-splade-modal
  close-explicitly
  :close-button="false"
  position="top"
  max-width="xl">

  <!-- Modal content -->
  <div class="relative p-4 sm:p-5">

    <!-- Modal header -->
    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">

      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
        Add guardian
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
      :action="route('guardians.store')"
      @success="$splade.emit('guardian-added')"
      autocomplete="off"
      class="space-y-6"
      stay>

      <div
        class="grid grid-cols-2 gap-2">
        <x-splade-input
          id="firat_name"
          type="text"
          name="first_name"
          placeholder="Enter guardian's first name"
          :label="__('First name')"
          autofocus />

        <x-splade-input
          id="last_name"
          type="text"
          name="last_name"
          placeholder="Enter guardian's last name"
          :label="__('Last name')" />
      </div>

      <x-splade-input
        id="email"
        type="email"
        name="email"
        placeholder="Enter guardian's email address"
        :label="__('Email')" />

      <div
        class="grid grid-cols-2 gap-2">

        <x-splade-input
          id="password"
          type="password"
          name="password"
          placeholder="Provide a temporary password for the guardian"
          :label="__('Password')" />

        <x-splade-input
          id="password_confirmation"
          type="password"
          placeholder="Verify the password you provided"
          name="password_confirmation"
          :label="__('Confirm Password')" />

      </div>

      <div class="flex items-center justify-end">
        <x-splade-submit class="ml-4 bg-lime-500 hover:bg-opacity-75" :label="__('Create')" />
      </div>

  </x-splade-form>

  </div>

</x-splade-modal>

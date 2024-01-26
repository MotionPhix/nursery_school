<script setup>
import { Menu, MenuButton, MenuItems } from '@headlessui/vue';
import { IconChevronDown } from '@tabler/icons-vue';
</script>

<template>
  <Menu as="div" class="relative inline-block text-left">
    <div>
      <MenuButton
        class="inline-flex justify-center w-full px-4 py-2 text-sm font-semibold text-gray-800 bg-gray-300 rounded-md hover:bg-gray-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
      >
        Filter by year
        <IconChevronDown
          class="w-5 h-5 ml-2 -mr-1 text-blue-500 hover:text-blue-400"
          aria-hidden="true"
        />
      </MenuButton>
    </div>

    <transition
      enter-active-class="transition duration-100 ease-out"
      enter-from-class="transform scale-95 opacity-0"
      enter-to-class="transform scale-100 opacity-100"
      leave-active-class="transition duration-75 ease-in"
      leave-from-class="transform scale-100 opacity-100"
      leave-to-class="transform scale-95 opacity-0"
    >
      <MenuItems
        class="absolute right-0 w-56 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black/5 focus:outline-none"
      >
        <div class="px-1 py-1">
          <slot />
        </div>
      </MenuItems>
    </transition>
  </Menu>
</template>

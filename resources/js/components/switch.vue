<script setup>
import { ref } from 'vue'
import { UseDark } from '@vueuse/components'

const switchOn = ref(false)
const switchId = 'switch'

function toggleSwitch() {
  switchOn.value = !switchOn.value
}
</script>

<template>
  <div class="flex items-center justify-center space-x-2">
    <UseDark v-slot="{ isDark, toggleDark }">
      <button ref="switchButton" type="button" :class="{ 'bg-lime-600': isDark, 'bg-neutral-300': !isDark }" class="relative inline-flex h-5 py-0.5 ml-4 focus:outline-none rounded-full w-9" @click="toggleDark(); toggleSwitch()">
        <span :class="{ 'translate-x-[18px]': isDark, 'translate-x-0.5': !isDark }" class="w-4 h-4 duration-500 ease-in-out dark:bg-lime-900 bg-white rounded-full shadow-md" />
      </button>

      <label :class="{ 'text-gray-200': isDark, 'text-gray-700': !isDark }" class="font-bold text-sm select-none" @click="$refs.switchButton.click(); $refs.switchButton.focus()">
        {{ isDark ? 'Dark' : 'Light' }} mode
      </label>
    </UseDark>
  </div>
</template>

<style scoped>
/* Add your CSS styles here */
</style>

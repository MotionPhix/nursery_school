<script setup>
import axios from 'axios'
import { ref } from 'vue'

const props = defineProps({
  availableYears: {
    type: Array,
    default: () => [],
  },
})

const allYears = props.availableYears
const selectedYear = ref('')
const newYear = ref('')

function handleChange() {
  if (selectedYear.value === 'new')
    newYear.value = ''
}

function createSchoolYear() {
  const currentYear = {
    year: newYear,
  }

  axios.post('/school-years', currentYear)
    .then((response) => {
      const createdYear = response.data // Assuming the response is { id: 1, year: '2021-2022' }

      // Update the availableYears array with the newly created school_year
      allYears.push(createdYear)

      // Set the selectedYear to the ID of the newly created school_year
      selectedYear.value = createdYear.id
    })
    .catch((error) => {
      console.error(error)
    })
}

console.log(props.availableYears)
</script>

<template>
  <div class="flex items-center">
    <div
      v-if="selectedYear !== 'new'"
      class="flex flex-1 border border-gray-300 rounded-md shadow-sm dark:border-gray-600 "
    >
      <select
        v-model="selectedYear"
        class="block w-full border-0 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-500 dark:focus:border-lime-500"
        @change="handleChange"
      >
        <option value="" disabled>
          Pick school enrollment year
        </option>

        <option v-for="school_year in allYears" :key="school_year.id" :value="school_year.id">
          {{ school_year.year }}
        </option>

        <option value="new">
          New school year
        </option>
      </select>
    </div>

    <div v-if="selectedYear === 'new'" class="flex items-center w-full gap-2">
      <div class="flex flex-1 border border-gray-300 rounded-md shadow-sm dark:border-gray-600">
        <input
          v-model="newYear" type="text" placeholder="Enter new school year"
          class="block w-full border-0 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-500 dark:focus:border-lime-500"
        >
      </div>

      <button
        type="button"
        class="px-2 py-2 font-bold text-gray-200 rounded-md bg-rose-500"
        @click="createSchoolYear"
      >
        Create
      </button>
    </div>
  </div>
</template>

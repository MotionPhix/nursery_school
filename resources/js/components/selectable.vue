<script setup>
import { onMounted, onUnmounted, reactive, ref, watch } from 'vue'

const selectOpen = ref(false)
const selectedItem = ref(null)
const selectableItems = reactive([
  {
    title: 'Milk',
    value: 'milk',
    disabled: false,
  },
  // ... add more items ...
])

const selectableItemActive = ref(null)
const selectId = 'select'
let selectKeydownTimeout = null
let selectDropdownPosition = 'bottom'

function selectableItemIsActive(item) {
  return selectableItemActive.value && selectableItemActive.value.value === item.value
}

function selectableItemActiveNext() {
  const index = selectableItems.indexOf(selectableItemActive.value)
  if (index < selectableItems.length - 1) {
    selectableItemActive.value = selectableItems[index + 1]
    selectScrollToActiveItem()
  }
}

function selectableItemActivePrevious() {
  const index = selectableItems.indexOf(selectableItemActive.value)
  if (index > 0) {
    selectableItemActive.value = selectableItems[index - 1]
    selectScrollToActiveItem()
  }
}

function selectScrollToActiveItem() {
  if (selectableItemActive.value) {
    const activeElement = document.getElementById(`${selectableItemActive.value.value}-${selectId}`)
    const newScrollPos = (activeElement.offsetTop + activeElement.offsetHeight) - $refs.selectableItemsList.offsetHeight
    if (newScrollPos > 0)
      $refs.selectableItemsList.scrollTop = newScrollPos
    else
      $refs.selectableItemsList.scrollTop = 0
  }
}

function selectKeydown(event) {
  if (event.keyCode >= 65 && event.keyCode <= 90) {
    selectKeydownValue += event.key
    const selectedItemBestMatch = selectItemsFindBestMatch()
    if (selectedItemBestMatch) {
      if (selectOpen.value) {
        selectableItemActive.value = selectedItemBestMatch
        selectScrollToActiveItem()
      }
      else {
        selectedItem.value = selectableItemActive.value = selectedItemBestMatch
      }
    }

    if (selectKeydownValue !== '') {
      clearTimeout(selectKeydownTimeout)
      selectKeydownTimeout = setTimeout(() => {
        selectKeydownValue = ''
      }, selectKeydownTimeout)
    }
  }
}

function selectItemsFindBestMatch() {
  const typedValue = selectKeydownValue.toLowerCase()
  let bestMatch = null
  let bestMatchIndex = -1
  for (let i = 0; i < selectableItems.length; i++) {
    const title = selectableItems[i].title.toLowerCase()
    const index = title.indexOf(typedValue)
    if (index > -1 && (bestMatchIndex === -1 || index < bestMatchIndex) && !selectableItems[i].disabled) {
      bestMatch = selectableItems[i]
      bestMatchIndex = index
    }
  }
  return bestMatch
}

function selectPositionUpdate() {
  const selectDropdownBottomPos = $refs.selectButton.getBoundingClientRect().top + $refs.selectButton.offsetHeight + Number.parseInt(window.getComputedStyle($refs.selectableItemsList).maxHeight)
  if (window.innerHeight < selectDropdownBottomPos)
    selectDropdownPosition = 'top'
  else
    selectDropdownPosition = 'bottom'
}

watch(selectOpen, () => {
  if (!selectedItem.value)
    selectableItemActive.value = selectableItems[0]
  else
    selectableItemActive.value = selectedItem.value

  setTimeout(() => {
    selectScrollToActiveItem()
  }, 10)
  selectPositionUpdate()
})

onMounted(() => {
  window.addEventListener('resize', selectPositionUpdate)
})

onUnmounted(() => {
  window.removeEventListener('resize', selectPositionUpdate)
})
</script>

<template>
  <div class="relative w-64">
    <button ref="selectButton" :class="{ 'focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400': !selectOpen }" class="relative min-h-[38px] flex items-center justify-between w-full py-2 pl-3 pr-10 text-left bg-white border rounded-md shadow-sm cursor-default border-neutral-200/70 focus:outline-none text-sm" @click="selectOpen = !selectOpen">
      <span>{{ selectedItem ? selectedItem.title : 'Select Item' }}</span>
      <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-gray-400">
          <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
        </svg>
      </span>
    </button>

    <ul v-show="selectOpen" ref="selectableItemsList" :class="{ 'bottom-0 mb-10': selectDropdownPosition === 'top', 'top-0 mt-10': selectDropdownPosition === 'bottom' }" class="absolute w-full py-1 mt-1 overflow-auto text-sm bg-white rounded-md shadow-md max-h-56 ring-1 ring-black ring-opacity-5 focus:outline-none" x-cloak @click.away="selectOpen = false">
      <template v-for="item in selectableItems" :key="item.value">
        <li :id="`${item.value}-${selectId}`" :data-disabled="item.disabled" :class="{ 'bg-neutral-100 text-gray-900': selectableItemIsActive(item), '': !selectableItemIsActive(item) }" class="relative flex items-center h-full py-2 pl-8 text-gray-700 cursor-default select-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none" @click="selectedItem = item; selectOpen = false; $refs.selectButton.focus()" @mousemove="selectableItemActive = item">
          <svg x-show="selectedItem.value === item.value" class="absolute left-0 w-4 h-4 ml-2 stroke-current text-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12" />
          </svg>
          <span class="block font-medium truncate">{{ item.title }}</span>
        </li>
      </template>
    </ul>
  </div>
</template>

<style>
.relative {
  position: relative;
}

.w-64 {
  width: 16rem;
}

.min-h-[38px] {
  min-height: 2.375rem;
}

.flex {
  display: flex;
}

.items-center {
  align-items: center;
}

.justify-between {
  justify-content: space-between;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.pl-3 {
  padding-left: 0.75rem;
}

.pr-10 {
  padding-right: 2.5rem;
}

.text-left {
  text-align: left;
}

.bg-white {
  background-color: #fff;
}

.border {
  border-width: 1px;
}

.rounded-md {
  border-radius: 0.375rem;
}

.shadow-sm {
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.cursor-default {
  cursor: default;
}

.focus\:outline-none:focus {
  outline: 2px solid transparent;
  outline-offset: 2px;
}

.text-sm {
  font-size: 0.875rem;
}

.absolute {
  position: absolute;
}

.inset-y-0 {
  top: 0;
  bottom: 0;
}

.right-0 {
  right: 0;
}

.pointer-events-none {
  pointer-events: none;
}

.w-5 {
  width: 1.25rem;
}

.h-5 {
  height: 1.25rem;
}

.text-gray-400 {
  color: #cbd5e0;
}

.fill-current {
  fill: currentColor;
}

.truncate {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

[data-disabled='true'] {
  opacity: 0.5;
  pointer-events: none;
}

.bg-neutral-100 {
  background-color: #edf2f7;
}

.text-gray-900 {
  color: #1a202c;
}

.relative {
  position: relative;
}

.h-full {
  height: 100%;
}

.select-none {
  user-select: none;
}

.selectable-item-active {
  background-color: #edf2f7;
  color: #1a202c;
}
</style>

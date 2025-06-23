<template>
  <div class="relative border border-blue-100 p-4 rounded-md shadow bg-white">
    <!-- Close Button (for edit mode only) -->


    <form @submit.prevent="submit" class="space-y-5">
      <!-- Title -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Task Title</label>
        <input
          v-model="form.title"
          type="text"
          placeholder="e.g. Design dashboard layout"
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
          required
        />
      </div>

      <!-- Accordion-style Status Dropdown with Colored Badge -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <div class="relative">
          <button
            type="button"
            @click="showStatusOptions = !showStatusOptions"
            class="w-full flex justify-between items-center border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200 transition"
          >
            <span class="flex items-center gap-2">
              <span :class="badgeColor(form.status)" class="w-2 h-2 rounded-full"></span>
              {{ statusLabel(form.status) }}
            </span>
            <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': showStatusOptions }"
              fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 9l6 6 6-6" />
            </svg>
          </button>

          <transition name="fade">
            <div
              v-if="showStatusOptions"
              class="absolute z-10 w-full bg-white border border-gray-200 mt-1 rounded shadow"
            >
              <ul class="text-sm divide-y divide-gray-100">
                <li
                  v-for="option in ['pending', 'in_progress', 'done']"
                  :key="option"
                  @click="selectStatus(option)"
                  class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 cursor-pointer"
                >
                  <span :class="badgeColor(option)" class="w-2 h-2 rounded-full"></span>
                  {{ statusLabel(option) }}
                </li>
              </ul>
            </div>
          </transition>
        </div>
      </div>

      <!-- Due Date -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
        <input
          v-model="form.due_date"
          type="date"
          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
        />
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end">
       <button
      v-if="props.task"
      @click="$emit('cancel-edit')"
      class="absolute top-2 right-2 text-gray-400 hover:text-red-500 text-xl font-bold"
      title="Cancel Editing"
    >
      X close
    </button>
        <button
          type="submit"
          class="inline-flex items-center bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded shadow hover:bg-blue-700 transition"
        >
           Update Task
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
  task: Object,
  projectId: String
})

const emit = defineEmits(['cancel-edit'])

const form = useForm({
  title: props.task?.title || '',
  status: props.task?.status || 'pending',
  due_date: props.task?.due_date || '',
})

const showStatusOptions = ref(false)

function selectStatus(status) {
  form.status = status
  showStatusOptions.value = false
}

function statusLabel(status) {
  return status.replace('_', ' ').replace(/\b\w/g, c => c.toUpperCase())
}

function badgeColor(status) {
  switch (status) {
    case 'pending': return 'bg-blue-500'
    case 'in_progress': return 'bg-orange-500'
    case 'done': return 'bg-green-600'
    default: return 'bg-gray-300'
  }
}

function submit() {
  const method = props.task
    ? form.put(route('tasks.update', [props.projectId, props.task.id]), {
        onSuccess: () => {
          showStatusOptions.value = false
          alert('✅ Task updated successfully.')
          form.reset()
          emit('cancel-edit')
        },
      })
    : form.post(route('tasks.store', props.projectId), {
        onSuccess: () => {
          showStatusOptions.value = false
          alert('✅ Task created successfully.')
          form.reset()
        },
      })
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.2s ease-in-out;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(-4px);
}
</style>

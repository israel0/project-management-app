<template>
  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">📁 {{ project.title }}</h2>
        <span class="text-sm text-gray-500">Tasks: {{ tasks.length }}</span>
      </div>
    </template>

    <div class="max-w-7xl mx-auto py-10 px-4">
      <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <!-- Task Form Column (4 cols) -->
        <div class="md:col-span-4 bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
          <h3 class="text-lg font-semibold text-gray-800 mb-4">➕ New Task</h3>
          <TaskForm :project-id="project.id" @task-created="refreshPage" />
        </div>

        <!-- Task List Column (8 cols) -->
        <div class="md:col-span-8 space-y-4">
          <div class="flex items-center gap-4 mb-4">
            <select v-model="filters.status" @change="applyFilters" class="border-gray-300 rounded-md px-3 py-2 text-sm">
              <option value="">All Statuses</option>
              <option v-for="status in statuses" :key="status" :value="status">
                {{ status.replace('_', ' ') }}
              </option>
            </select>

            <input type="date" v-model="filters.due_date" @change="applyFilters" class="border-gray-300 rounded-md px-3 py-2 text-sm" />
          </div>

          <div v-if="tasks.length" class="space-y-4">
            <div
              v-for="task in tasks"
              :key="task.id"
              class="bg-white rounded-xl shadow border p-5 transition hover:shadow-md"
            >
              <div class="flex justify-between items-start">
                <div>
                  <h4 class="text-lg font-semibold text-gray-900">{{ task.title }}</h4>
                  <p class="text-sm text-gray-500 mt-1">Status: {{ task.status.replace('_', ' ') }}</p>
                  <p v-if="task.due_date" class="text-sm text-gray-400 mt-1">Due: {{ formatDate(task.due_date) }}</p>
                </div>

                <div class="space-x-2">
                  <button @click="editTask(task)" class="text-blue-600 text-sm hover:underline">Edit</button>
                  <button @click="deleteTask(task.id)" class="text-red-600 text-sm hover:underline">Delete</button>
                </div>
              </div>

              <!-- Inline Edit Accordion -->
              <div v-if="editingTask?.id === task.id" class="mt-4 border-t pt-4">
                <TaskForm
                  :task="editingTask"
                  :project-id="project.id"
                  submit-label="Update Task"
                  @task-updated="clearEditing"
                />
              </div>
            </div>
          </div>

          <p v-else class="text-center text-gray-500 mt-6">No tasks found 🚀</p>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import TaskForm from '@/Pages/Tasks/TaskForm.vue'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import { format } from 'date-fns'

const props = defineProps({
  project: Object,
  tasks: Array,
  statuses: Array,
  filters: Object,
})

const filters = ref({ ...props.filters })
const editingTask = ref(null)

function applyFilters() {
  router.visit(route('projects.show', props.project.id), {
    preserveState: true,
    preserveScroll: true,
    data: filters.value,
  })
}

function deleteTask(taskId) {
  if (confirm('Are you sure you want to delete this task?')) {
    router.delete(route('tasks.destroy', [props.project.id, taskId]), {
      onSuccess: () => refreshPage(),
    })
  }
}

function editTask(task) {
  editingTask.value = { ...task }
}

function clearEditing() {
  editingTask.value = null
  refreshPage()
}

function refreshPage() {
  router.visit(route('projects.show', props.project.id), {
    preserveScroll: true,
  })
}

function formatDate(date) {
  return format(new Date(date), 'MMM d, yyyy')
}
</script>

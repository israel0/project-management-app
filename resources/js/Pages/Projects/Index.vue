<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-2xl font-bold text-gray-800">Projects</h2>
    </template>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <div class="mb-6 text-right">
        <Link :href="route('projects.create')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          + New Project
        </Link>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="project in projects" :key="project.id" class="bg-white shadow rounded p-4">
          <h3 class="text-lg font-semibold">{{ project.title }}</h3>
          <p class="text-gray-600 text-sm mb-2">{{ project.description || 'No description.' }}</p>
          <p v-if="project.deadline" class="text-xs text-gray-500">Deadline: {{ formatDate(project.deadline) }}</p>

          <div class="mt-4 flex justify-between items-center">
            <Link
              :href="route('projects.show', project.id)"
              class="text-blue-600 hover:underline text-sm"
            >
              {{ project.tasks_count > 0 ? 'Manage Tasks' : 'Add First Task' }}
            </Link>

            <div class="space-x-2">
              <Link :href="route('projects.edit', project.id)" class="text-yellow-600 hover:underline text-sm">
                Edit
              </Link>
              <button @click="destroy(project.id)" class="text-red-600 hover:underline text-sm">
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { format } from 'date-fns';

const props = defineProps({
  projects: Array,
});

function formatDate(date) {
  return format(new Date(date), 'MMM d, yyyy');
}

function destroy(id) {
  if (confirm('Are you sure you want to delete this project?')) {
    router.delete(route('projects.destroy', id));
  }
}
</script>

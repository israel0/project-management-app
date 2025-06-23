// Directory: resources/js/Pages/Projects/Create.vue
<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-2xl font-bold text-gray-800">Create Project</h2>
    </template>

    <div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <form @submit.prevent="submit" class="space-y-6 bg-white shadow p-6 rounded">
        <div>
          <label class="block text-sm font-medium text-gray-700">Title</label>
          <input v-model="form.title" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Description</label>
          <textarea v-model="form.description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Deadline</label>
          <input v-model="form.deadline" type="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>

        <div class="flex justify-end">
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Save Project
          </button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, router } from '@inertiajs/vue3';

const form = useForm({
  title: '',
  description: '',
  deadline: '',
});

function submit() {
  form.post(route('projects.store'));
}
</script>

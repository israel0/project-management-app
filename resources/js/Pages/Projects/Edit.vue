<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-2xl font-bold text-gray-800">Edit Project</h2>
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
          <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Update Project
          </button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  project: Object,
});

const form = useForm({
  title: props.project.title,
  description: props.project.description,
  deadline: props.project.deadline,
});

function submit() {
  form.put(route('projects.update', props.project.id));
}
</script>

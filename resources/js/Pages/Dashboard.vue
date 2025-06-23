<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    totalProjects: Number,
    tasksCompletedToday: Number,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Project Card - Clickable -->
                <Link :href="route('projects.index')" class="block bg-white shadow rounded-lg p-6 transition transform hover:scale-105 hover:shadow-lg cursor-pointer">
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Total Projects</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ totalProjects }}</p>
                    <p class="text-sm text-blue-600 mt-1">View all projects →</p>
                </Link>

                <!-- Task Completion Card -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Tasks Completed Today</h3>
                    <p class="text-3xl font-bold text-green-600">{{ tasksCompletedToday }}</p>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>

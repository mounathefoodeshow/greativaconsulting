<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    jobs: Object
});

const toggleForm = useForm({});

const togglePublish = (job) => {
    toggleForm.patch(route('admin.jobs.toggle', job.id), {
        preserveScroll: true
    });
};

const deleteJob = (job) => {
    if (confirm(`Are you sure you want to archive "${job.title}"?`)) {
        router.delete(route('admin.jobs.destroy', job.id));
    }
};

const forceDeleteJob = (job) => {
    if (confirm(`WARNING: Are you sure you want to PERMANENTLY delete "${job.title}"? This cannot be undone.`)) {
        router.delete(route('admin.jobs.force-delete', job.id));
    }
};

const formatDate = (dateString) => {
    if (!dateString) return 'N/A';
    return new Date(dateString).toLocaleDateString();
};
</script>

<template>
    <Head title="Manage Jobs" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Manage Jobs
                </h2>
                <Link
                    :href="route('admin.jobs.create')"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500"
                >
                    Create New Job
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                            <thead class="bg-gray-50 uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Title</th>
                                    <th scope="col" class="px-6 py-3">Department</th>
                                    <th scope="col" class="px-6 py-3">Deadline</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Published</th>
                                    <th scope="col" class="px-6 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="job in jobs.data" :key="job.id" class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ job.title }}
                                    </td>
                                    <td class="px-6 py-4">{{ job.department }}</td>
                                    <td class="px-6 py-4">{{ formatDate(job.application_deadline) }}</td>
                                    <td class="px-6 py-4">
                                        <span v-if="job.deleted_at" class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Archived</span>
                                        <span v-else class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Active</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button 
                                            @click="togglePublish(job)"
                                            :disabled="job.deleted_at != null"
                                            :class="[
                                                'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2',
                                                job.is_active ? 'bg-indigo-600' : 'bg-gray-200',
                                                job.deleted_at ? 'opacity-50 cursor-not-allowed' : ''
                                            ]"
                                            role="switch"
                                        >
                                            <span 
                                                aria-hidden="true" 
                                                :class="[
                                                    'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                                                    job.is_active ? 'translate-x-5' : 'translate-x-0'
                                                ]"
                                            />
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <Link
                                            :href="route('admin.jobs.edit', job.id)"
                                            class="font-medium text-indigo-600 hover:underline dark:text-indigo-500"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            v-if="!job.deleted_at"
                                            @click="deleteJob(job)"
                                            class="font-medium text-yellow-600 hover:underline dark:text-yellow-500"
                                        >
                                            Archive
                                        </button>
                                        <button
                                            @click="forceDeleteJob(job)"
                                            class="font-medium text-red-600 hover:underline dark:text-red-500"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="jobs.data.length === 0">
                                    <td colspan="6" class="px-6 py-4 text-center">
                                        No jobs found.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const props = defineProps({
    job: {
        type: Object,
        default: null
    }
});

const isEditing = !!props.job;

const form = useForm({
    title: props.job?.title || '',
    department: props.job?.department || '',
    contract_type: props.job?.contract_type || '',
    location: props.job?.location || '',
    description: props.job?.description || '',
    skills: props.job?.skills || '',
    benefits: props.job?.benefits || '',
    application_deadline: props.job?.application_deadline || '',
    is_active: props.job?.is_active ?? true,
});

const submit = () => {
    if (isEditing) {
        form.put(route('admin.jobs.update', props.job.id));
    } else {
        form.post(route('admin.jobs.store'));
    }
};
</script>

<template>
    <Head :title="isEditing ? 'Edit Job' : 'Create Job'" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ isEditing ? 'Edit Job' : 'Create Job' }}
                </h2>
                <Link
                    :href="route('admin.jobs.index')"
                    class="rounded-md bg-gray-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500"
                >
                    Back to Jobs
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form @submit.prevent="submit" class="space-y-6">
                            
                            <!-- Title & Department -->
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="title" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Title</label>
                                    <div class="mt-2">
                                        <input type="text" v-model="form.title" id="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-900 dark:text-gray-100 dark:ring-gray-700" required>
                                    </div>
                                    <p v-if="form.errors.title" class="mt-2 text-sm text-red-600">{{ form.errors.title }}</p>
                                </div>
                                <div>
                                    <label for="department" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Department</label>
                                    <div class="mt-2">
                                        <input type="text" v-model="form.department" id="department" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-900 dark:text-gray-100 dark:ring-gray-700" required>
                                    </div>
                                    <p v-if="form.errors.department" class="mt-2 text-sm text-red-600">{{ form.errors.department }}</p>
                                </div>
                            </div>

                            <!-- Contract Type & Location -->
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="contract_type" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Contract Type</label>
                                    <div class="mt-2">
                                        <input type="text" v-model="form.contract_type" id="contract_type" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-900 dark:text-gray-100 dark:ring-gray-700" required>
                                    </div>
                                    <p v-if="form.errors.contract_type" class="mt-2 text-sm text-red-600">{{ form.errors.contract_type }}</p>
                                </div>
                                <div>
                                    <label for="location" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Location</label>
                                    <div class="mt-2">
                                        <input type="text" v-model="form.location" id="location" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-900 dark:text-gray-100 dark:ring-gray-700" required>
                                    </div>
                                    <p v-if="form.errors.location" class="mt-2 text-sm text-red-600">{{ form.errors.location }}</p>
                                </div>
                            </div>

                            <!-- Deadline & Is Active -->
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="application_deadline" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300">Application Deadline</label>
                                    <div class="mt-2">
                                        <input type="date" v-model="form.application_deadline" id="application_deadline" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-gray-900 dark:text-gray-100 dark:ring-gray-700">
                                    </div>
                                    <p v-if="form.errors.application_deadline" class="mt-2 text-sm text-red-600">{{ form.errors.application_deadline }}</p>
                                </div>
                                <div>
                                    <div class="mt-8 flex items-center h-6">
                                        <input id="is_active" v-model="form.is_active" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="is_active" class="ml-3 text-sm leading-6 text-gray-900 dark:text-gray-300">Publish Immediately</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Description (Rich Text) -->
                            <div>
                                <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300 mb-2">Description</label>
                                <div class="bg-white dark:bg-gray-900 text-black dark:text-white rounded-md border border-gray-300 dark:border-gray-700 shadow-sm h-[200px]">
                                    <QuillEditor 
                                        v-model:content="form.description" 
                                        contentType="html" 
                                        theme="snow"
                                        class="h-[150px]"
                                    />
                                </div>
                                <p v-if="form.errors.description" class="mt-2 text-sm text-red-600">{{ form.errors.description }}</p>
                            </div>

                            <!-- Skills (Rich Text) -->
                            <div>
                                <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300 mb-2">Requirements & Skills</label>
                                <div class="bg-white dark:bg-gray-900 text-black dark:text-white rounded-md border border-gray-300 dark:border-gray-700 shadow-sm h-[200px]">
                                    <QuillEditor 
                                        v-model:content="form.skills" 
                                        contentType="html" 
                                        theme="snow"
                                        class="h-[150px]"
                                    />
                                </div>
                                <p v-if="form.errors.skills" class="mt-2 text-sm text-red-600">{{ form.errors.skills }}</p>
                            </div>

                            <!-- Benefits (Rich Text) -->
                            <div>
                                <label class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-300 mb-2">Benefits (Optional)</label>
                                <div class="bg-white dark:bg-gray-900 text-black dark:text-white rounded-md border border-gray-300 dark:border-gray-700 shadow-sm h-[200px]">
                                    <QuillEditor 
                                        v-model:content="form.benefits" 
                                        contentType="html" 
                                        theme="snow"
                                        class="h-[150px]"
                                    />
                                </div>
                                <p v-if="form.errors.benefits" class="mt-2 text-sm text-red-600">{{ form.errors.benefits }}</p>
                            </div>

                            <div class="flex justify-end gap-x-3 pt-4">
                                <Link
                                    :href="route('admin.jobs.index')"
                                    class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-800 dark:text-white dark:ring-gray-600"
                                >
                                    Cancel
                                </Link>
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:opacity-50"
                                >
                                    {{ isEditing ? 'Update Job' : 'Create Job' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';

const props = defineProps({
    jobs: Object,
    filters: Object,
});

const search = ref(props.filters.search || '');
const department = ref(props.filters.department || '');
const contractType = ref(props.filters.contract_type || '');

watch([search, department, contractType], debounce(() => {
    router.get('/jobs', {
        search: search.value,
        department: department.value,
        contract_type: contractType.value,
    }, { preserveState: true, replace: true });
}, 300));
</script>

<template>
    <Head title="Job Openings" />

    <div class="min-h-screen bg-gray-50 text-gray-900 font-sans">
        <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-600/30">
                        <span class="text-white font-bold text-xl">G</span>
                    </div>
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 tracking-tight">
                        Greativa HR
                    </span>
                </div>
                <div class="flex items-center space-x-6 text-sm font-medium">
                    <div class="text-gray-500 hover:text-indigo-600 cursor-pointer transition-colors duration-200">
                        FR / EN
                    </div>
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('admin.jobs.index')"
                        class="text-gray-500 hover:text-indigo-600 transition-colors duration-200"
                    >
                        Manage Jobs
                    </Link>
                    <Link
                        v-else
                        :href="route('login')"
                        class="text-gray-500 hover:text-indigo-600 transition-colors duration-200"
                    >
                        Admin Login
                    </Link>
                </div>
            </div>
        </header>

        <div class="bg-indigo-900 text-white py-20 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 to-purple-900"></div>
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-white opacity-5 blur-3xl"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight mb-6">
                    Join Our Mission
                </h1>
                <p class="text-xl md:text-2xl text-indigo-200 max-w-2xl mx-auto font-light">
                    Discover exciting career opportunities at Greativa Consulting Group.
                </p>
            </div>
        </div>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-10">
            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-6 mb-12 flex flex-col md:flex-row gap-4 relative z-20 border border-gray-100">
                <div class="flex-1 relative">
                    <svg class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input v-model="search" type="text" placeholder="Search by job title or keyword..." class="w-full pl-12 pr-4 py-3 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition-shadow duration-200" />
                </div>
                <div class="w-full md:w-64">
                    <select v-model="department" class="w-full py-3 px-4 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition-shadow duration-200 bg-white">
                        <option value="">All Departments</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Design">Design</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Sales">Sales</option>
                        <option value="HR">HR</option>
                    </select>
                </div>
                <div class="w-full md:w-64">
                    <select v-model="contractType" class="w-full py-3 px-4 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition-shadow duration-200 bg-white">
                        <option value="">All Contract Types</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                        <option value="Internship">Internship</option>
                    </select>
                </div>
            </div>

            <div class="space-y-6">
                <template v-if="jobs.data.length > 0">
                    <div v-for="job in jobs.data" :key="job.id" class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl border border-gray-100 hover:border-indigo-100 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 ring-1 ring-inset ring-indigo-600/20">
                                        {{ job.department }}
                                    </span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        {{ job.contract_type }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200">
                                    <Link :href="route('jobs.show', job.id)">{{ job.title }}</Link>
                                </h3>
                                <div class="mt-2 flex items-center text-sm text-gray-500 gap-4">
                                    <div class="flex items-center gap-1">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ job.location }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <Link :href="route('jobs.show', job.id)" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 w-full md:w-auto shadow-md shadow-indigo-600/20">
                                    View Details
                                </Link>
                            </div>
                        </div>
                    </div>
                </template>
                <div v-else class="text-center py-20 bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <h3 class="text-lg font-medium text-gray-900">No jobs found</h3>
                    <p class="mt-1 text-gray-500">Try adjusting your search or filters to find what you're looking for.</p>
                </div>
            </div>

            <div class="mt-10 flex justify-center space-x-2" v-if="jobs.links && jobs.links.length > 3">
                <template v-for="(link, p) in jobs.links" :key="p">
                    <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border border-gray-200 rounded-xl" v-html="link.label"></div>
                    <Link v-else :href="link.url" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border border-gray-200 rounded-xl hover:bg-gray-50 focus:border-indigo-500 focus:text-indigo-500 transition-colors duration-200" :class="{ 'bg-indigo-600 text-white border-indigo-600 hover:bg-indigo-700': link.active }" v-html="link.label"></Link>
                </template>
            </div>
        </main>
    </div>
</template>

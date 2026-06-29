<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationForm from '@/Components/ApplicationForm.vue';

const props = defineProps({
    job: Object,
});
</script>

<template>
    <Head :title="job.title" />

    <div class="min-h-screen bg-gray-50 text-gray-900 font-sans">
        <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-600/30">
                        <span class="text-white font-bold text-xl">G</span>
                    </div>
                    <Link :href="route('jobs.index')" class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 tracking-tight">
                        Greativa HR
                    </Link>
                </div>
                <Link :href="route('jobs.index')" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors">
                    &larr; Back to Jobs
                </Link>
            </div>
        </header>

        <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-8 md:p-12 mb-8 border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-indigo-50 rounded-full blur-3xl opacity-50"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold bg-indigo-50 text-indigo-700 ring-1 ring-inset ring-indigo-600/20">
                            {{ job.department }}
                        </span>
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                            {{ job.contract_type }}
                        </span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900 mb-6">
                        {{ job.title }}
                    </h1>
                    
                    <div class="flex flex-wrap items-center gap-6 text-gray-500 font-medium">
                        <div class="flex items-center gap-2">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ job.location }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Posted {{ new Date(job.created_at).toLocaleDateString() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Job Description</h2>
                        <div class="prose prose-indigo max-w-none text-gray-600 whitespace-pre-wrap">
                            {{ job.description }}
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Required Skills</h2>
                        <div class="prose prose-indigo max-w-none text-gray-600 whitespace-pre-wrap">
                            {{ job.skills }}
                        </div>
                    </div>

                    <div v-if="job.benefits" class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Benefits & Perks</h2>
                        <div class="prose prose-indigo max-w-none text-gray-600 whitespace-pre-wrap">
                            {{ job.benefits }}
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-28 bg-white rounded-3xl p-8 shadow-xl shadow-gray-200/50 border border-gray-100 text-center">
                        <div class="w-16 h-16 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Ready to apply?</h3>
                        <p class="text-sm text-gray-500 mb-8">Join us and help build the future of Greativa Consulting.</p>
                        
                        <a href="#apply-form" class="inline-flex w-full items-center justify-center px-6 py-4 border border-transparent text-base font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 shadow-lg shadow-indigo-600/30 transform hover:-translate-y-0.5">
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
            
            <div id="apply-form" class="mt-16 pt-8 border-t border-gray-200">
                <ApplicationForm :jobId="job.id" />
            </div>
        </main>
    </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    jobId: {
        type: Number,
        required: true
    }
});

const fileInput = ref(null);

const form = useForm({
    full_name: '',
    email: '',
    phone: '',
    cv: null,
    linkedin_url: '',
    portfolio_url: '',
    cover_letter: '',
});

const submitForm = () => {
    form.post(route('applications.store', props.jobId), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            if(fileInput.value) fileInput.value.value = null;
        },
    });
};

const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        if (file.size > 5 * 1024 * 1024) {
            form.setError('cv', 'The file must not be greater than 5MB.');
            e.target.value = null;
            form.cv = null;
            return;
        }
        if (file.type !== 'application/pdf') {
            form.setError('cv', 'The file must be a PDF.');
            e.target.value = null;
            form.cv = null;
            return;
        }
        form.clearErrors('cv');
        form.cv = file;
    }
};
</script>

<template>
    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 text-left">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Submit Your Application</h2>
        
        <div v-if="$page.props.flash && $page.props.flash.success" class="mb-6 p-4 bg-emerald-50 rounded-xl border border-emerald-200">
            <div class="flex items-center text-emerald-800">
                <svg class="h-5 w-5 mr-2 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">Success!</span>
                <span class="ml-2">{{ $page.props.flash.success }}</span>
            </div>
        </div>

        <form @submit.prevent="submitForm" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                    <input v-model="form.full_name" type="text" required class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition-shadow py-3 px-4" placeholder="John Doe">
                    <div v-if="form.errors.full_name" class="mt-1 text-sm text-red-600">{{ form.errors.full_name }}</div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                    <input v-model="form.email" type="email" required class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition-shadow py-3 px-4" placeholder="john@example.com">
                    <div v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</div>
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
                    <input v-model="form.phone" type="tel" required class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition-shadow py-3 px-4" placeholder="+1 (555) 000-0000">
                    <div v-if="form.errors.phone" class="mt-1 text-sm text-red-600">{{ form.errors.phone }}</div>
                </div>

                <!-- CV Upload -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">CV / Resume (PDF) <span class="text-red-500">*</span></label>
                    <input ref="fileInput" type="file" accept=".pdf" required @change="handleFileChange" class="w-full text-gray-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors border border-gray-200 rounded-xl cursor-pointer bg-white">
                    <p class="text-xs text-gray-400 mt-1">Max file size: 5 MB</p>
                    <div v-if="form.errors.cv" class="mt-1 text-sm text-red-600">{{ form.errors.cv }}</div>
                </div>

                <!-- LinkedIn URL -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">LinkedIn URL</label>
                    <input v-model="form.linkedin_url" type="url" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition-shadow py-3 px-4" placeholder="https://linkedin.com/in/johndoe">
                    <div v-if="form.errors.linkedin_url" class="mt-1 text-sm text-red-600">{{ form.errors.linkedin_url }}</div>
                </div>

                <!-- Portfolio URL -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Portfolio / Website</label>
                    <input v-model="form.portfolio_url" type="url" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition-shadow py-3 px-4" placeholder="https://johndoe.com">
                    <div v-if="form.errors.portfolio_url" class="mt-1 text-sm text-red-600">{{ form.errors.portfolio_url }}</div>
                </div>
            </div>

            <!-- Cover Letter -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Cover Letter / Message</label>
                <textarea v-model="form.cover_letter" rows="5" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition-shadow py-3 px-4" placeholder="Tell us why you're a great fit for this role..."></textarea>
                <div v-if="form.errors.cover_letter" class="mt-1 text-sm text-red-600">{{ form.errors.cover_letter }}</div>
            </div>

            <p class="text-xs text-gray-400 mt-4">
                This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.
            </p>

            <button type="submit" :disabled="form.processing" class="w-full md:w-auto px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold transition-colors shadow-md shadow-indigo-600/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                <span v-if="form.processing">Submitting Application...</span>
                <span v-else>Submit Application</span>
            </button>
        </form>
    </div>
</template>

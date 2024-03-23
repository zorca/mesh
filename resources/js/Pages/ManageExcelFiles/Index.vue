<script setup>
import { reactive } from "vue";
import { router, useForm } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

const form = useForm({
    file: null,
});

function store() {
    form.post(route('manage-excel-files.store'));
}
</script>

<template>
    <DefaultLayout title="Manage Excel Files">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Manage Excel Files
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                            <p class="max-w-lg mx-auto mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                                <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">Upload XLS or XLSX files</h1>
                                <form @submit.prevent="store">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file">Upload file</label>
                                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_help" id="file" type="file" @input="form.file = $event.target.files[0]">
                                    <p v-if="form.errors.file" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.file }}</p>
                                    <button type="submit" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                                </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Link } from '@inertiajs/vue3'
import {
    FwbButton,
    FwbA,
    FwbTable,
    FwbTableBody,
    FwbTableCell,
    FwbTableHead,
    FwbTableHeadCell,
    FwbTableRow,
    FwbPagination,
    FwbCard,
} from 'flowbite-vue'

defineProps({ entities: Array });
</script>

<template>
    <DefaultLayout title="Manage Imported Rows">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Manage Imported Rows
                </h2>
                <Link :href="route('manage-excel-files.destroy-all')" method="delete" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Destroy All</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                            <p class="max-w-lg mx-auto mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                                <div>
                                    <fwb-card class="mb-4 p-4" v-for="(item, index) in entities.data" variant="horizontal">
                                        <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ index }}</h2>
                                        <ul>
                                            <li v-for="(child_item, index) in item">
                                                <span class="p-2">{{ child_item.row_id }}</span>
                                                <span class="p-2">{{ child_item.name }}</span>
                                                <span class="p-2">{{ child_item.date }}</span>
                                            </li>
                                        </ul>
                                    </fwb-card>
                                </div>
                                <div class="mt-2 flex items-center justify-between text-center">
                                    <Link class="text-white bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg dark:bg-blue-600 focus:outline-none dark:focus:ring-blue-800 hover:bg-blue-800 dark:hover:bg-blue-700 text-sm px-4 py-2" :href="entities.prev_page_url">Prev</Link>
                                    <Link class="text-white bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg dark:bg-blue-600 focus:outline-none dark:focus:ring-blue-800 hover:bg-blue-800 dark:hover:bg-blue-700 text-sm px-4 py-2" :href="entities.next_page_url">Next</Link>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

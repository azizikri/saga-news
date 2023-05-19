<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Link, usePage } from '@inertiajs/vue3';

const admin = usePage().props.admin;

defineProps({
    article_count: Number,
    user_count: Number,
    category_count: Number,
});
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Dashboard
                </h2>
            </div>
        </template>

        <div class="flex p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

            <Link :href="route('articles.index')"
                class="block w-full max-w-md p-8 mx-4 mb-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Articles</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400" v-html="article_count"></p>
            </Link>

            <Link :href="route('categories.index')"
                class="block w-full max-w-md p-8 mx-4 mb-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Categories</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400" v-html="category_count"></p>
            </Link>

            <Link :href="route('admin.users.index')" v-if="admin"
                class="block w-full max-w-md p-8 mx-4 mb-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Users</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400" v-html="user_count"></p>
            </Link>
        </div>
    </AuthenticatedLayout>
</template>

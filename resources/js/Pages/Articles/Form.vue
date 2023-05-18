<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import CreateForm from './Partials/CreateForm.vue';
import EditForm from './Partials/EditForm.vue';
import { ArrowLeftIcon } from '@heroicons/vue/outline'
import { Link } from '@inertiajs/vue3';


defineProps({
    categories: Array,
    article: Object
})
</script>

<template>
    <AuthenticatedLayout title="Article">
        <template #header>
            <div class="flex items-center">
                <Link :href="route('articles.index')">
                <ArrowLeftIcon class="flex-shrink-0 w-5 h-5 mr-3" aria-hidden="true" />
                </Link>

                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Article
                </h2>
            </div>
        </template>

        <div class="space-y-6">
            <div v-if="route().current('articles.create')"
                class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <CreateForm class="max-w-xl" :categories="categories" />
            </div>

            <div v-if="route().current('articles.edit')" class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <EditForm class="max-w-xl" :categories="categories" :article="article" />
            </div>

        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import CreateForm from './Partials/CreateForm.vue';
import EditForm from './Partials/EditForm.vue';
import { ArrowLeftIcon } from '@heroicons/vue/outline'
import { Link } from '@inertiajs/vue3';


defineProps({
    category: Object
})

</script>

<template>
    <AuthenticatedLayout title="Category">
        <template #header>
            <div class="flex items-center">
                <Link :href="route('categories.index')">
                <ArrowLeftIcon class="flex-shrink-0 w-5 h-5 mr-3" aria-hidden="true" />
                </Link>

                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Category
                </h2>
            </div>
        </template>

        <div class="space-y-6">
            <div v-if="route().current('categories.create')"
                class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <CreateForm class="max-w-xl" />
            </div>

            <div v-if="route().current('categories.edit')" class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <EditForm class="max-w-xl" :category="category" />
            </div>

        </div>
    </AuthenticatedLayout>
</template>

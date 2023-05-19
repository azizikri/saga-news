<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { ArrowLeftIcon } from '@heroicons/vue/outline'
import { Link } from '@inertiajs/vue3';



defineProps({
    article: Object
})
</script>

<template>
    <AuthenticatedLayout title="Detail Article">
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

        <div class="container px-4 py-8 mx-auto">
            <div class="max-w-3xl mx-auto">
                <h1 class="mb-4 text-3xl font-bold">{{ article.title }}</h1>
                <p class="text-gray-600">{{ article.user }}</p>
                <sm class="mb-4 text-sm text-gray-600">Published on {{ article.created_at }}</sm>
                <img class="h-auto max-w-lg my-5 rounded-lg" :src="article.banner" alt="image description">


                <div class="prose max-w-none" v-html="article.content"></div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>




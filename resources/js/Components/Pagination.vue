<template>
    <div>
        <Component :is="link.url ? 'Link' : 'span'" v-for="link in links" :href="link.url" v-html="link.label" class="px-1"
            :class="link.url ? '' : 'text-gray-500 dark:text-gray-400'" />
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Link
    },
    props: {
        links: Array
    }
}
</script>

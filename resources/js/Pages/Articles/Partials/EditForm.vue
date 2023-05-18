<script setup>
import InputError from '@/Components/InputError.vue'
import Label from '@/Components/Label.vue'
import Button from '@/Components/Button.vue'
import Input from '@/Components/Input.vue'
import { useForm, usePage, router } from '@inertiajs/vue3';

const article = usePage().props.article;

const form = useForm({
    category_id: article.category_id,
    title: article.title,
    content: article.content,
    banner: null,
});

function submit() {
    const formData = {
        _method: 'patch',
        category_id: form.category_id,
        title: form.title,
        content: form.content,
    };

    if (form.banner) {
        formData.banner = form.banner;
    }

    router.post(route('articles.update', article.slug), formData);

    console.log(form.banner);
}

defineProps({
    categories: Object,
})



</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Update Article
            </h2>
        </header>

        <form @submit.prevent="submit()" class="mt-6 space-y-6">
            <div>
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select the category</label>
                <select id="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.category_id">
                    <option v-for="(name, id) in categories" :key="id" :value="id">{{ name }}</option>
                </select>

                <InputError class="mt-2" :message="form.errors.category_id" />

            </div>

            <div>
                <Label for="title" value="Title" />

                <Input id="title" type="text" class="block w-full mt-1" v-model="form.title" required
                    autocomplete="title" />

                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div>
                <Label for="banner" value="Banner" />

                <Input id="banner" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" @input="form.banner = $event.target.files[0]" autocomplete="banner" />
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">WEBP, PNG, JPG or GIF.</p>

                <InputError class="mt-2" :message="form.errors.banner" />
            </div>

            <div>
                <Label for="content" value="Content" />

                <textarea id="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." v-model="form.content" required></textarea>
                <InputError class="mt-2" :message="form.errors.content" />
            </div>

            <div class="flex items-center gap-4">
                <Button :disabled="form.processing">Save</Button>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>

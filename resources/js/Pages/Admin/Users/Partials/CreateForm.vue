<script setup>
import InputError from '@/Components/InputError.vue'
import Label from '@/Components/Label.vue'
import Button from '@/Components/Button.vue'
import Input from '@/Components/Input.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

function submit() {
    form.post(route('admin.users.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    })
}

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Create new User
            </h2>
        </header>

        <form @submit.prevent="submit()" class="mt-6 space-y-6">
            <div>
                <Label for="name" value="Name" />

                <Input id="name" type="text" class="block w-full mt-1" v-model="form.name" required autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <Label for="email" value="Email" />

                <Input id="email" type="email" class="block w-full mt-1" v-model="form.email" required
                    autocomplete="email" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <Label for="password" value="Password" />

                <Input id="password" type="password" class="block w-full mt-1" v-model="form.password" required
                    autocomplete="password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div>
                <Label for="password_confirmation" value="Confirm Password" />

                <Input id="password_confirmation" type="password" class="block w-full mt-1"
                    v-model="form.password_confirmation" required autocomplete="password_confirmation" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
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

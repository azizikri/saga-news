<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import { UserIcon, MailIcon, LockClosedIcon, UserAddIcon } from '@heroicons/vue/outline'
import GuestLayout from '@/Layouts/Guest.vue'
import InputIconWrapper from '@/Components/InputIconWrapper.vue'
import Input from '@/Components/Input.vue'
import Label from '@/Components/Label.vue'
import ValidationErrors from '@/Components/ValidationErrors.vue'
import Button from '@/Components/Button.vue'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
})

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    })
}
</script>

<template>
    <GuestLayout title="Register">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="grid gap-6">
                <div class="space-y-2">
                    <Label for="name" value="Name" />
                    <InputIconWrapper>
                        <template #icon>
                            <UserIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input withIcon id="name" type="text" placeholder="Name" class="block w-full" v-model="form.name"
                            required autofocus autocomplete="name" />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label for="email" value="Email" />
                    <InputIconWrapper>
                        <template #icon>
                            <MailIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input withIcon id="email" type="email" class="block w-full" placeholder="Email"
                            v-model="form.email" required autocomplete="username" />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label for="password" value="Password" />
                    <InputIconWrapper>
                        <template #icon>
                            <LockClosedIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input withIcon id="password" type="password" class="block w-full" placeholder="Password"
                            v-model="form.password" required autocomplete="new-password" />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label for="password_confirmation" value="Confirm Password" />
                    <InputIconWrapper>
                        <template #icon>
                            <LockClosedIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input withIcon id="password_confirmation" type="password" class="block w-full"
                            placeholder="Confirm Password" v-model="form.password_confirmation" required
                            autocomplete="new-password" />
                    </InputIconWrapper>
                </div>

                <div>
                    <Button class="justify-center w-full gap-2" :disabled="form.processing" v-slot="{ iconSizeClasses }">
                        <UserAddIcon aria-hidden="true" :class="iconSizeClasses" />
                        <span>Register</span>
                    </Button>
                </div>

                <p class="text-sm text-center text-gray-600 dark:text-gray-400">
                    Or
                </p>

                <a :href="route('google.login')"
                        class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2 justify-center w-full gap-2">
                    <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab"
                        data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                        <path fill="currentColor"
                            d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z">
                        </path>
                    </svg>
                    Register with Google
                    </a>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Already have an account?
                    <Link :href="route('login')" class="text-blue-500 hover:underline">
                    Login
                    </Link>
                </p>

            </div>

    </form>
</GuestLayout></template>

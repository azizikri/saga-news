<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import { MailIcon, LockClosedIcon, LoginIcon } from '@heroicons/vue/outline'
import InputIconWrapper from '@/Components/InputIconWrapper.vue'
import Button from '@/Components/Button.vue'
import Checkbox from '@/Components/Checkbox.vue'
import GuestLayout from '@/Layouts/Guest.vue'
import Input from '@/Components/Input.vue'
import Label from '@/Components/Label.vue'
import ValidationErrors from '@/Components/ValidationErrors.vue'

defineProps({
    canResetPassword: Boolean,
    status: String,
})

const form = useForm({
    email: '',
    password: '',
    remember: false
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>
    <GuestLayout title="Log in">
        <ValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="grid gap-6">
                <div class="space-y-2">
                    <Label for="email" value="Email" />
                    <InputIconWrapper>
                        <template #icon>
                            <MailIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input withIcon id="email" type="email" class="block w-full" placeholder="Email"
                            v-model="form.email" required autofocus autocomplete="username" />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label for="password" value="Password" />
                    <InputIconWrapper>
                        <template #icon>
                            <LockClosedIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input withIcon id="password" type="password" class="block w-full" placeholder="Password"
                            v-model="form.password" required autocomplete="current-password" />
                    </InputIconWrapper>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>

                    <Link v-if="canResetPassword" :href="route('password.request')"
                        class="text-sm text-blue-500 hover:underline">
                    Forgot your password?
                    </Link>
                </div>

                <div>
                    <Button class="justify-center w-full gap-2" :disabled="form.processing" v-slot="{ iconSizeClasses }">
                        <LoginIcon aria-hidden="true" :class="iconSizeClasses" />
                        <span>Log in</span>
                    </Button>

                    <a :href="route('google.login')"
                        class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2 justify-center w-full gap-2 mt-3">
                    <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab"
                        data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                        <path fill="currentColor"
                            d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z">
                        </path>
                    </svg>
                    Login with Google
                    </a>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Don't have an account?
                    <Link :href="route('register')" class="text-blue-500 hover:underline">
                    Register
                    </Link>
                </p>
            </div>
        </form>
    </GuestLayout>
</template>
